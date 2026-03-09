<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BetOnline Diffusion Explorer</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 16px;
            background: #f7f7f7;
            color: #222;
        }
        h1, h2, h3 {
            margin: 0 0 12px;
        }
        .row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }
        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            box-sizing: border-box;
        }
        .panel.wide {
            width: 100%;
        }
        .panel.left {
            flex: 0 0 420px;
            min-width: 360px;
        }
        .panel.right {
            flex: 1 1 700px;
            min-width: 420px;
        }
        .panel.half {
            flex: 1 1 560px;
            min-width: 380px;
        }
        label {
            display: block;
            font-weight: bold;
            margin: 8px 0 4px;
        }
        input, textarea, button, select {
            font: inherit;
            box-sizing: border-box;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #bbb;
            border-radius: 8px;
            background: #fff;
        }
        textarea {
            min-height: 84px;
            resize: vertical;
        }
        button {
            padding: 8px 12px;
            border: 1px solid #999;
            border-radius: 8px;
            background: #f1f1f1;
            cursor: pointer;
        }
        button:hover {
            background: #e7e7e7;
        }
        #status {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .log {
            background: #111;
            color: #ddd;
            padding: 10px;
            border-radius: 8px;
            white-space: pre-wrap;
            word-break: break-word;
            max-height: 360px;
            overflow: auto;
            font-family: Consolas, monospace;
            font-size: 12px;
        }
        .muted {
            color: #666;
            font-size: 12px;
        }
        .controls {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            background: #efefef;
            border: 1px solid #ccc;
            font-size: 12px;
            margin-right: 6px;
            margin-bottom: 6px;
        }
        .list {
            max-height: 520px;
            overflow: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
        }
        .match-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }
        .match-item:hover {
            background: #fafafa;
        }
        .match-item.active {
            background: #eef6ff;
            border-left: 4px solid #4b8ef7;
            padding-left: 6px;
        }
        .match-title {
            font-weight: bold;
            margin-bottom: 4px;
        }
        .match-meta {
            font-size: 12px;
            color: #555;
            line-height: 1.35;
        }
        .json-list {
            max-height: 480px;
            overflow: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            padding: 8px;
        }
        .json-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;
        }
        .json-topic {
            font-weight: bold;
            margin-bottom: 6px;
            color: #333;
            word-break: break-word;
        }
        .small {
            font-size: 11px;
            color: #555;
        }
        .history-wrap {
            max-height: 360px;
            overflow: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            font-size: 12px;
            vertical-align: top;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
        tr:hover {
            background: #fafafa;
        }
        .clickable-row {
            cursor: pointer;
        }
        .mono {
            font-family: Consolas, monospace;
            font-size: 12px;
        }
        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
    </style>

    <script>
        window.__RE_STATE__ = {
            realSocket: null,
            sockets: [],
            socketCounter: 0,
            transportLogBuffer: [],
            packetHistory: [],
            packetCounter: 0,
            jsonMessages: [],
            matches: new Map(),
            selectedFixtureId: null,
            manualStreams: new Set()
        };

        function __safeStringify(v) {
            if (v instanceof Error) return v.stack || v.message;
            if (typeof v === "object") {
                try { return JSON.stringify(v, null, 2); }
                catch { return String(v); }
            }
            return String(v);
        }

        function __pushTransportLog(...args) {
            const text = args.map(__safeStringify).join(" ");
            window.__RE_STATE__.transportLogBuffer.push(text);
            console.log(...args);

            const el = document.getElementById("transportLog");
            if (el) {
                el.textContent += text + "\n";
                el.scrollTop = el.scrollHeight;
            }
        }

        function __bytesToHex(u8) {
            return Array.from(u8, b => b.toString(16).padStart(2, "0")).join(" ");
        }

        function __bytesToAscii(u8) {
            return Array.from(u8, b => (b >= 32 && b <= 126 ? String.fromCharCode(b) : ".")).join("");
        }

        function __bytesToBase64(u8) {
            let s = "";
            for (let i = 0; i < u8.length; i++) s += String.fromCharCode(u8[i]);
            return btoa(s);
        }

        function __asciiPrintable(u8) {
            return Array.from(u8).every(b => b >= 32 && b <= 126);
        }

        function __decodePacket(u8) {
            try {
                if (!(u8 instanceof Uint8Array) || u8.length < 2) {
                    return { kind: "unknown", note: "too short" };
                }

                if (u8.length >= 5 && u8[0] === 0x00 && u8[1] === 0x5e && u8[2] === 0x0a && u8[3] === 0x06) {
                    const len = u8[4];
                    const payload = u8.slice(5);
                    const str = new TextDecoder().decode(payload);
                    return {
                        kind: "selector-subscribe",
                        lengthByte: len,
                        actualPayloadLength: payload.length,
                        selector: str,
                        lengthMatches: len === payload.length
                    };
                }

                if (u8.length >= 5 && u8[0] === 0x00 && u8[1] === 0x03) {
                    const seq = u8[2];
                    const len = u8[3];
                    const payload = u8.slice(4);
                    const str = new TextDecoder().decode(payload);
                    return {
                        kind: "topic-subscribe",
                        seq,
                        lengthByte: len,
                        actualPayloadLength: payload.length,
                        topicString: str,
                        topicPath: str.startsWith(">") ? str.slice(1) : str,
                        lengthMatches: len === payload.length
                    };
                }

                if (__asciiPrintable(u8)) {
                    return { kind: "ascii", text: new TextDecoder().decode(u8) };
                }

                return { kind: "unknown", note: "pattern not recognized" };
            } catch (e) {
                return { kind: "decode-error", error: String(e) };
            }
        }

        function __describeFrame(prefix, u8) {
            const parsed = __decodePacket(u8);
            __pushTransportLog(
                prefix,
                "\nlen:", u8.length,
                "\nhex:", __bytesToHex(u8),
                "\nascii:", __bytesToAscii(u8),
                "\nbase64:", __bytesToBase64(u8),
                "\nparsed:", parsed,
                "\n---"
            );
        }

        function __recordPacket(direction, socketId, u8) {
            const parsed = __decodePacket(u8);
            const entry = {
                id: ++window.__RE_STATE__.packetCounter,
                time: new Date().toISOString(),
                direction,
                socketId,
                len: u8.length,
                hex: __bytesToHex(u8),
                ascii: __bytesToAscii(u8),
                base64: __bytesToBase64(u8),
                parsed
            };
            window.__RE_STATE__.packetHistory.unshift(entry);
            if (window.__RE_STATE__.packetHistory.length > 300) {
                window.__RE_STATE__.packetHistory.length = 300;
            }
            if (typeof renderPacketHistory === "function") renderPacketHistory();
        }

        (function installWebSocketHookEarly() {
            const NativeWS = window.WebSocket;
            if (!NativeWS) return;

            function HookedWebSocket(...args) {
                const ws = new NativeWS(...args);
                ws.__socketId = ++window.__RE_STATE__.socketCounter;
                window.__RE_STATE__.realSocket = ws;
                window.__RE_STATE__.sockets.push(ws);

                __pushTransportLog(`[WS#${ws.__socketId}] created`, args[0]);

                ws.addEventListener("open", () => {
                    window.__RE_STATE__.realSocket = ws;
                    __pushTransportLog(`[WS#${ws.__socketId}] open`);
                    if (typeof updateBadges === "function") updateBadges();
                });

                ws.addEventListener("close", (e) => {
                    __pushTransportLog(`[WS#${ws.__socketId}] close code=${e.code} reason=${e.reason || ""}`);
                    if (typeof updateBadges === "function") updateBadges();
                });

                ws.addEventListener("error", () => {
                    __pushTransportLog(`[WS#${ws.__socketId}] error`);
                    if (typeof updateBadges === "function") updateBadges();
                });

                ws.addEventListener("message", async (ev) => {
                    try {
                        if (typeof ev.data === "string") {
                            __pushTransportLog(`[WS#${ws.__socketId}] IN TEXT`, ev.data);
                            return;
                        }

                        let ab;
                        if (ev.data instanceof ArrayBuffer) ab = ev.data;
                        else if (ev.data instanceof Blob) ab = await ev.data.arrayBuffer();
                        else {
                            __pushTransportLog(`[WS#${ws.__socketId}] IN UNKNOWN`, Object.prototype.toString.call(ev.data));
                            return;
                        }

                        const u8 = new Uint8Array(ab);
                        __recordPacket("IN", ws.__socketId, u8);
                        __describeFrame(`[WS#${ws.__socketId}] IN BIN`, u8);
                    } catch (err) {
                        __pushTransportLog(`[WS#${ws.__socketId}] IN decode error`, err);
                    }
                });

                const originalSend = ws.send;
                ws.send = function(data) {
                    try {
                        if (typeof data === "string") {
                            __pushTransportLog(`[WS#${ws.__socketId}] OUT TEXT`, data);
                        } else if (data instanceof ArrayBuffer) {
                            const u8 = new Uint8Array(data);
                            __recordPacket("OUT", ws.__socketId, u8);
                            __describeFrame(`[WS#${ws.__socketId}] OUT BIN`, u8);
                        } else if (ArrayBuffer.isView(data)) {
                            const u8 = new Uint8Array(data.buffer, data.byteOffset, data.byteLength);
                            __recordPacket("OUT", ws.__socketId, u8);
                            __describeFrame(`[WS#${ws.__socketId}] OUT BIN`, u8);
                        } else if (data instanceof Blob) {
                            data.arrayBuffer().then(ab => {
                                const u8 = new Uint8Array(ab);
                                __recordPacket("OUT", ws.__socketId, u8);
                                __describeFrame(`[WS#${ws.__socketId}] OUT BIN`, u8);
                            });
                        }
                    } catch (err) {
                        __pushTransportLog(`[WS#${ws.__socketId}] OUT log error`, err);
                    }

                    return originalSend.call(this, data);
                };

                return ws;
            }

            HookedWebSocket.prototype = NativeWS.prototype;
            Object.setPrototypeOf(HookedWebSocket, NativeWS);
            window.WebSocket = HookedWebSocket;
            __pushTransportLog("[init] WebSocket hook installed BEFORE diffusion.js");
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/diffusion@6.9.1/dist/diffusion.js"></script>
</head>
<body>
<h1>BetOnline Diffusion Explorer</h1>

<div id="status">Готово</div>
<div style="margin-bottom:12px;">
    <span class="badge" id="socketStatusBadge">socket: unknown</span>
    <span class="badge" id="historyStatusBadge">history: 0</span>
    <span class="badge" id="jsonStatusBadge">json: 0</span>
    <span class="badge" id="matchesStatusBadge">matches: 0</span>
</div>

<div class="row">
    <div class="panel half">
        <h2>Подключение</h2>

        <label for="selectorInput">Широкий selector</label>
        <input id="selectorInput" type="text" value="?rdd/ui/bol//" />

        <div class="controls">
            <button id="connectBtn">Подключиться</button>
            <button id="selectBtn">Стартовая подписка</button>
            <button id="reloadBtn">Сбросить страницу</button>
        </div>

        <div class="muted" style="margin-top:8px;">
            Сначала подключение, потом стартовая подписка. После этого слева появится список реальных матчей.
        </div>
    </div>

    <div class="panel half">
        <h2>Подписка на выбранный матч</h2>

        <label for="fixtureIdInput">fixtureId</label>
        <input id="fixtureIdInput" type="text" placeholder="выбирается автоматически из списка" />

        <label for="selectedBaseTopicInput">Base topic выбранного матча</label>
        <input id="selectedBaseTopicInput" type="text" readonly />

        <div class="controls">
            <button id="subscribeBaseBtn">Подписаться на base</button>
            <button id="subscribeDetailBtn">Подписаться на detail</button>
            <button id="subscribeLobbyBtn">Подписаться на lobby</button>
            <button id="subscribeMostPopularBtn">Подписаться на most-popular</button>
            <button id="subscribeInsightsBtn">Подписаться на insights</button>
            <button id="subscribeMarketsBtn">Подписаться на markets/.*</button>
        </div>

        <div class="muted" style="margin-top:8px;">
            Здесь используются реальные base topics, найденные во входящих топиках, а не догадки.
        </div>
    </div>
</div>

<div class="row">
    <div class="panel left">
        <h2>Список матчей</h2>

        <div class="controls">
            <select id="phaseFilter">
                <option value="ALL">Все фазы</option>
                <option value="live">live</option>
                <option value="upcoming">upcoming</option>
                <option value="prematch">prematch</option>
            </select>

            <input id="sportFilter" type="text" placeholder="Фильтр по спорту, например tennis" />
        </div>

        <div class="controls">
            <input id="matchFilter" type="text" placeholder="Поиск по league / fixtureId / topic" />
            <button id="clearMatchesBtn">Очистить список</button>
        </div>

        <div id="matchesList" class="list" style="margin-top:8px;"></div>
    </div>

    <div class="panel right">
        <h2>Выбранный матч</h2>

        <div id="selectedMatchInfo" class="log" style="background:#f8f8f8;color:#222;border:1px solid #ddd;"></div>

        <h3 style="margin-top:12px;">События по выбранному матчу</h3>
        <div id="selectedMatchEvents" class="json-list"></div>
    </div>
</div>

<div class="row">
    <div class="panel half">
        <h2>Raw / base64</h2>
        <label for="base64Input">Base64 пакета</label>
        <textarea id="base64Input"></textarea>
        <div class="controls">
            <button id="parseBase64Btn">Разобрать base64</button>
            <button id="sendBase64Btn">Отправить raw base64</button>
        </div>
        <div id="builtPacketLog" class="log" style="margin-top:8px;"></div>
    </div>

    <div class="panel half">
        <h2>Лог приложения</h2>
        <div id="appLog" class="log"></div>
    </div>
</div>

<div class="row">
    <div class="panel wide">
        <h2>История бинарных пакетов</h2>
        <div class="controls">
            <select id="historyFilterDirection">
                <option value="ALL">Все</option>
                <option value="OUT">Только OUT</option>
                <option value="IN">Только IN</option>
            </select>
            <select id="historyFilterKind">
                <option value="ALL">Все типы</option>
                <option value="selector-subscribe">selector-subscribe</option>
                <option value="topic-subscribe">topic-subscribe</option>
                <option value="unknown">unknown</option>
            </select>
            <input id="historyFilterText" type="text" placeholder="Фильтр по selector/topic/base64/hex" />
            <button id="clearHistoryBtn">Очистить историю</button>
        </div>

        <div class="history-wrap" style="margin-top:8px;">
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Dir</th>
                    <th>WS</th>
                    <th>Len</th>
                    <th>Kind</th>
                    <th>Target</th>
                    <th>Base64</th>
                </tr>
                </thead>
                <tbody id="packetHistoryBody"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="panel half">
        <h2>Лог транспорта</h2>
        <div id="transportLog" class="log"></div>
    </div>

    <div class="panel half">
        <h2>Все входящие JSON</h2>
        <div class="controls">
            <input id="jsonFilterText" type="text" placeholder="Фильтр по topic" />
            <button id="clearJsonBtn">Очистить JSON</button>
        </div>
        <div id="items" class="json-list" style="margin-top:8px;"></div>
    </div>
</div>

<script>
    const statusEl = document.getElementById("status");
    const appLogEl = document.getElementById("appLog");
    const transportLogEl = document.getElementById("transportLog");
    const itemsEl = document.getElementById("items");
    const builtPacketLogEl = document.getElementById("builtPacketLog");
    const matchesListEl = document.getElementById("matchesList");
    const selectedMatchInfoEl = document.getElementById("selectedMatchInfo");
    const selectedMatchEventsEl = document.getElementById("selectedMatchEvents");

    const socketStatusBadge = document.getElementById("socketStatusBadge");
    const historyStatusBadge = document.getElementById("historyStatusBadge");
    const jsonStatusBadge = document.getElementById("jsonStatusBadge");
    const matchesStatusBadge = document.getElementById("matchesStatusBadge");

    const selectorInput = document.getElementById("selectorInput");
    const fixtureIdInput = document.getElementById("fixtureIdInput");
    const selectedBaseTopicInput = document.getElementById("selectedBaseTopicInput");
    const base64Input = document.getElementById("base64Input");

    const phaseFilter = document.getElementById("phaseFilter");
    const sportFilter = document.getElementById("sportFilter");
    const matchFilter = document.getElementById("matchFilter");

    const connectBtn = document.getElementById("connectBtn");
    const selectBtn = document.getElementById("selectBtn");
    const reloadBtn = document.getElementById("reloadBtn");

    const subscribeBaseBtn = document.getElementById("subscribeBaseBtn");
    const subscribeDetailBtn = document.getElementById("subscribeDetailBtn");
    const subscribeLobbyBtn = document.getElementById("subscribeLobbyBtn");
    const subscribeMostPopularBtn = document.getElementById("subscribeMostPopularBtn");
    const subscribeInsightsBtn = document.getElementById("subscribeInsightsBtn");
    const subscribeMarketsBtn = document.getElementById("subscribeMarketsBtn");

    const parseBase64Btn = document.getElementById("parseBase64Btn");
    const sendBase64Btn = document.getElementById("sendBase64Btn");

    const packetHistoryBody = document.getElementById("packetHistoryBody");
    const historyFilterDirection = document.getElementById("historyFilterDirection");
    const historyFilterKind = document.getElementById("historyFilterKind");
    const historyFilterText = document.getElementById("historyFilterText");
    const clearHistoryBtn = document.getElementById("clearHistoryBtn");

    const jsonFilterText = document.getElementById("jsonFilterText");
    const clearJsonBtn = document.getElementById("clearJsonBtn");
    const clearMatchesBtn = document.getElementById("clearMatchesBtn");

    let session = null;

    function appLog(...args) {
        console.log(...args);
        appLogEl.textContent += args.map(__safeStringify).join(" ") + "\n";
        appLogEl.scrollTop = appLogEl.scrollHeight;
    }

    function setStatus(text) {
        statusEl.textContent = text;
    }

    function updateBadges() {
        const ws = window.__RE_STATE__.realSocket;
        socketStatusBadge.textContent = ws
            ? `socket: #${ws.__socketId}, readyState=${ws.readyState}`
            : "socket: none";
        historyStatusBadge.textContent = `history: ${window.__RE_STATE__.packetHistory.length}`;
        jsonStatusBadge.textContent = `json: ${window.__RE_STATE__.jsonMessages.length}`;
        matchesStatusBadge.textContent = `matches: ${window.__RE_STATE__.matches.size}`;
    }

    function base64ToBytes(b64) {
        const clean = b64.replace(/\s+/g, "");
        return Uint8Array.from(atob(clean), c => c.charCodeAt(0));
    }

    function bytesToBase64(u8) {
        return __bytesToBase64(u8);
    }

    function getRealSocket() {
        const ws = window.__RE_STATE__.realSocket;
        if (!ws) return null;
        if (ws.readyState !== 1) return null;
        return ws;
    }

    function shortTarget(parsed) {
        if (!parsed || !parsed.kind) return "";
        if (parsed.kind === "selector-subscribe") return parsed.selector || "";
        if (parsed.kind === "topic-subscribe") return parsed.topicPath || parsed.topicString || "";
        return parsed.note || "";
    }

    function renderPacketHistory() {
        const dir = historyFilterDirection.value;
        const kind = historyFilterKind.value;
        const text = historyFilterText.value.trim().toLowerCase();

        packetHistoryBody.innerHTML = "";

        for (const entry of window.__RE_STATE__.packetHistory) {
            if (dir !== "ALL" && entry.direction !== dir) continue;
            if (kind !== "ALL" && (entry.parsed?.kind || "unknown") !== kind) continue;

            const haystack = [
                entry.hex,
                entry.base64,
                entry.ascii,
                entry.parsed?.selector,
                entry.parsed?.topicPath,
                entry.parsed?.topicString,
                entry.parsed?.kind
            ].filter(Boolean).join(" ").toLowerCase();

            if (text && !haystack.includes(text)) continue;

            const tr = document.createElement("tr");
            tr.className = "clickable-row";
            tr.innerHTML = `
          <td>${entry.id}</td>
          <td>${entry.time.split("T")[1].replace("Z","")}</td>
          <td>${entry.direction}</td>
          <td>#${entry.socketId}</td>
          <td>${entry.len}</td>
          <td>${entry.parsed?.kind || "unknown"}</td>
          <td>${escapeHtml(shortTarget(entry.parsed)).slice(0, 120)}</td>
          <td class="mono">${escapeHtml(entry.base64).slice(0, 80)}</td>
        `;
            tr.addEventListener("click", () => {
                base64Input.value = entry.base64;
                renderBuiltPacket("Пакет из истории", base64ToBytes(entry.base64));
            });
            packetHistoryBody.appendChild(tr);
        }

        updateBadges();
    }

    function renderBuiltPacket(title, u8) {
        const parsed = __decodePacket(u8);
        builtPacketLogEl.textContent =
            title + "\n\n" +
            "len: " + u8.length + "\n" +
            "hex: " + __bytesToHex(u8) + "\n" +
            "ascii: " + __bytesToAscii(u8) + "\n" +
            "base64: " + __bytesToBase64(u8) + "\n\n" +
            "parsed:\n" + __safeStringify(parsed);
    }

    function renderJsonMessages() {
        const filter = jsonFilterText.value.trim().toLowerCase();
        itemsEl.innerHTML = "";

        for (const entry of window.__RE_STATE__.jsonMessages) {
            if (filter && !entry.topic.toLowerCase().includes(filter)) continue;

            const div = document.createElement("div");
            div.className = "json-item";
            div.innerHTML = `
          <div class="json-topic">${escapeHtml(entry.topic)}</div>
          <div class="small">${entry.time}</div>
          <pre style="white-space:pre-wrap;word-break:break-word;margin-top:8px;">${escapeHtml(JSON.stringify(entry.data, null, 2))}</pre>
        `;
            itemsEl.appendChild(div);
        }

        updateBadges();
    }

    function escapeHtml(s) {
        return String(s)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;");
    }

    function parseEventTopic(topic) {
        const parts = topic.split("/");
        if (parts.length < 6) return null;

        // live/upcoming
        if (parts[0] === "rdd" && parts[1] === "ui" && parts[2] === "bol" && parts[3] === "event") {
            const phase = parts[4];
            const sport = parts[5];
            if (!["live", "upcoming"].includes(phase)) return null;

            const rest = parts.slice(6);
            let fixtureIdIndex = rest.findIndex(x => /^\d+$/.test(x));
            if (fixtureIdIndex === -1) return null;

            const league = rest.slice(0, fixtureIdIndex).join("/");
            const fixtureId = rest[fixtureIdIndex];
            const tail = rest.slice(fixtureIdIndex + 1);
            const baseTopic = ["rdd","ui","bol","event",phase,sport,league,fixtureId].filter(Boolean).join("/");

            return {
                family: "event",
                phase,
                sport,
                league,
                fixtureId,
                baseTopic,
                tail
            };
        }

        // prematch/event
        if (parts[0] === "rdd" && parts[1] === "ui" && parts[2] === "bol" && parts[3] === "prematch" && parts[4] === "event") {
            const phase = "prematch";
            const sport = parts[5];
            const rest = parts.slice(6);
            let fixtureIdIndex = rest.findIndex(x => /^\d+$/.test(x));
            if (fixtureIdIndex === -1) return null;

            const league = rest.slice(0, fixtureIdIndex).join("/");
            const fixtureId = rest[fixtureIdIndex];
            const tail = rest.slice(fixtureIdIndex + 1);
            const baseTopic = ["rdd","ui","bol","prematch","event",sport,league,fixtureId].filter(Boolean).join("/");

            return {
                family: "prematch-event",
                phase,
                sport,
                league,
                fixtureId,
                baseTopic,
                tail
            };
        }

        return null;
    }

    function ensureMatchFromTopic(topic) {
        const info = parseEventTopic(topic);
        if (!info) return null;

        let match = window.__RE_STATE__.matches.get(info.fixtureId);
        if (!match) {
            match = {
                fixtureId: info.fixtureId,
                phase: info.phase,
                sport: info.sport,
                league: info.league,
                baseTopic: info.baseTopic,
                topics: new Set(),
                lastSeen: null
            };
            window.__RE_STATE__.matches.set(info.fixtureId, match);
        }

        match.phase = info.phase;
        match.sport = info.sport;
        match.league = info.league;
        match.baseTopic = info.baseTopic;
        match.topics.add(topic);
        match.lastSeen = new Date().toISOString();
        return match;
    }

    function renderMatchesList() {
        const phase = phaseFilter.value;
        const sportText = sportFilter.value.trim().toLowerCase();
        const text = matchFilter.value.trim().toLowerCase();

        const arr = Array.from(window.__RE_STATE__.matches.values())
            .sort((a, b) => {
                if (a.phase !== b.phase) return a.phase.localeCompare(b.phase);
                if (a.sport !== b.sport) return a.sport.localeCompare(b.sport);
                return a.fixtureId.localeCompare(b.fixtureId);
            });

        matchesListEl.innerHTML = "";

        for (const m of arr) {
            if (phase !== "ALL" && m.phase !== phase) continue;
            if (sportText && !m.sport.toLowerCase().includes(sportText)) continue;

            const hay = [m.fixtureId, m.phase, m.sport, m.league, m.baseTopic].join(" ").toLowerCase();
            if (text && !hay.includes(text)) continue;

            const div = document.createElement("div");
            div.className = "match-item" + (window.__RE_STATE__.selectedFixtureId === m.fixtureId ? " active" : "");
            div.innerHTML = `
          <div class="match-title">${escapeHtml(m.sport)} / ${escapeHtml(m.league || "(league unknown)")}</div>
          <div class="match-meta">
            fixtureId: ${escapeHtml(m.fixtureId)}<br>
            phase: ${escapeHtml(m.phase)}<br>
            base: ${escapeHtml(m.baseTopic)}<br>
            topics seen: ${m.topics.size}
          </div>
        `;
            div.addEventListener("click", () => selectMatch(m.fixtureId));
            matchesListEl.appendChild(div);
        }

        updateBadges();
    }

    function selectMatch(fixtureId) {
        window.__RE_STATE__.selectedFixtureId = fixtureId;
        const m = window.__RE_STATE__.matches.get(fixtureId);
        if (!m) return;

        fixtureIdInput.value = m.fixtureId;
        selectedBaseTopicInput.value = m.baseTopic;

        selectedMatchInfoEl.textContent = JSON.stringify({
            fixtureId: m.fixtureId,
            phase: m.phase,
            sport: m.sport,
            league: m.league,
            baseTopic: m.baseTopic,
            topicsSeen: Array.from(m.topics)
        }, null, 2);

        renderMatchesList();
        renderSelectedMatchEvents();
        appLog("[match selected]", m);
    }

    function renderSelectedMatchEvents() {
        selectedMatchEventsEl.innerHTML = "";
        const fixtureId = window.__RE_STATE__.selectedFixtureId;
        if (!fixtureId) return;

        const filtered = window.__RE_STATE__.jsonMessages.filter(x => x.topic.includes(`/${fixtureId}`) || JSON.stringify(x.data).includes(`"fixtureId": ${fixtureId}`));

        for (const entry of filtered.slice(0, 80)) {
            const div = document.createElement("div");
            div.className = "json-item";
            div.innerHTML = `
          <div class="json-topic">${escapeHtml(entry.topic)}</div>
          <div class="small">${entry.time}</div>
          <pre style="white-space:pre-wrap;word-break:break-word;margin-top:8px;">${escapeHtml(JSON.stringify(entry.data, null, 2))}</pre>
        `;
            selectedMatchEventsEl.appendChild(div);
        }
    }

    function recordJson(topic, data) {
        window.__RE_STATE__.jsonMessages.unshift({
            time: new Date().toISOString(),
            topic,
            data
        });
        if (window.__RE_STATE__.jsonMessages.length > 250) {
            window.__RE_STATE__.jsonMessages.length = 250;
        }

        ensureMatchFromTopic(topic);
        renderJsonMessages();
        renderMatchesList();
        renderSelectedMatchEvents();
    }

    async function connect() {
        if (!window.diffusion) {
            setStatus("Ошибка: diffusion SDK не загрузился");
            return;
        }

        if (session) {
            appLog("[info] session уже создана");
            updateBadges();
            return;
        }

        try {
            session = await diffusion.connect({
                host: "api.betonline.ag",
                port: 443,
                secure: true,
                path: "/pushd"
            });

            setStatus("Подключено");
            appLog("[connected] session создана");
            updateBadges();

            if (typeof session.on === "function") {
                session.on({
                    disconnect: (reason) => {
                        appLog("[disconnect]", reason);
                        updateBadges();
                    },
                    error: (err) => {
                        appLog("[session error]", err);
                        updateBadges();
                    },
                    reconnect: () => {
                        appLog("[reconnect]");
                        updateBadges();
                    },
                    close: (reason) => {
                        appLog("[close]", reason);
                        updateBadges();
                    }
                });
            }
        } catch (e) {
            appLog("[connect failed]", e);
            setStatus("Ошибка подключения");
            updateBadges();
        }
    }

    function registerJsonStream(selector) {
        if (window.__RE_STATE__.manualStreams.has(selector)) {
            appLog("[stream already registered]", selector);
            return;
        }

        window.__RE_STATE__.manualStreams.add(selector);

        session
            .addStream(selector, diffusion.datatypes.json())
            .on("value", (topic, spec, newValue) => {
                try {
                    const data = newValue.get();
                    appLog("[json]", topic);
                    recordJson(topic, data);
                } catch (err) {
                    appLog("[json parse error]", topic, err);
                }
            });
    }

    async function sdkSubscribe(selector) {
        if (!session) {
            appLog("[error] session ещё не создана");
            return;
        }

        try {
            appLog("[sdk select start]", selector);
            registerJsonStream(selector);
            await session.select(selector);
            setStatus("Подписано: " + selector);
            appLog("[sdk select ok]", selector);
        } catch (e) {
            appLog("[sdk select failed]", e);
        }
    }

    function getSelectedMatch() {
        const fixtureId = window.__RE_STATE__.selectedFixtureId;
        if (!fixtureId) throw new Error("Сначала выбери матч из списка");
        const m = window.__RE_STATE__.matches.get(fixtureId);
        if (!m) throw new Error("Матч не найден");
        return m;
    }

    function buildSelectorsForMatch(m) {
        return {
            base: `?${m.baseTopic}`,
            detail: `?${m.baseTopic}/detail`,
            lobby: `?${m.baseTopic}/market-group/lobby`,
            mostPopular: `?${m.baseTopic}/market-group/most-popular`,
            insights: `?${m.baseTopic}/insights`,
            markets: `?${m.baseTopic}/markets/.*`
        };
    }

    async function subscribeSelected(kind) {
        const m = getSelectedMatch();
        const selectors = buildSelectorsForMatch(m);
        const selector = selectors[kind];
        if (!selector) throw new Error("Неизвестный вид подписки");
        await sdkSubscribe(selector);
    }

    function parseBase64Packet() {
        try {
            const u8 = base64ToBytes(base64Input.value);
            renderBuiltPacket("Разбор base64-пакета", u8);
        } catch (e) {
            appLog("[base64 parse failed]", e);
        }
    }

    function sendRawBase64() {
        const ws = getRealSocket();
        if (!ws) {
            appLog("[error] реальный WebSocket не готов");
            return;
        }

        try {
            const u8 = base64ToBytes(base64Input.value);
            appLog("[raw send base64]", {
                socketId: ws.__socketId,
                parsed: __decodePacket(u8),
                base64: __bytesToBase64(u8)
            });
            ws.send(u8);
        } catch (e) {
            appLog("[raw send base64 failed]", e);
        }
    }

    function clearHistory() {
        window.__RE_STATE__.packetHistory = [];
        renderPacketHistory();
    }

    function clearJson() {
        window.__RE_STATE__.jsonMessages = [];
        renderJsonMessages();
        renderSelectedMatchEvents();
    }

    function clearMatches() {
        window.__RE_STATE__.matches = new Map();
        window.__RE_STATE__.selectedFixtureId = null;
        fixtureIdInput.value = "";
        selectedBaseTopicInput.value = "";
        selectedMatchInfoEl.textContent = "";
        renderMatchesList();
        renderSelectedMatchEvents();
    }

    connectBtn.addEventListener("click", connect);
    selectBtn.addEventListener("click", () => sdkSubscribe(selectorInput.value.trim()));
    reloadBtn.addEventListener("click", () => location.reload());

    subscribeBaseBtn.addEventListener("click", async () => { try { await subscribeSelected("base"); } catch (e) { appLog(e); } });
    subscribeDetailBtn.addEventListener("click", async () => { try { await subscribeSelected("detail"); } catch (e) { appLog(e); } });
    subscribeLobbyBtn.addEventListener("click", async () => { try { await subscribeSelected("lobby"); } catch (e) { appLog(e); } });
    subscribeMostPopularBtn.addEventListener("click", async () => { try { await subscribeSelected("mostPopular"); } catch (e) { appLog(e); } });
    subscribeInsightsBtn.addEventListener("click", async () => { try { await subscribeSelected("insights"); } catch (e) { appLog(e); } });
    subscribeMarketsBtn.addEventListener("click", async () => { try { await subscribeSelected("markets"); } catch (e) { appLog(e); } });

    parseBase64Btn.addEventListener("click", parseBase64Packet);
    sendBase64Btn.addEventListener("click", sendRawBase64);

    historyFilterDirection.addEventListener("change", renderPacketHistory);
    historyFilterKind.addEventListener("change", renderPacketHistory);
    historyFilterText.addEventListener("input", renderPacketHistory);
    clearHistoryBtn.addEventListener("click", clearHistory);

    jsonFilterText.addEventListener("input", renderJsonMessages);
    clearJsonBtn.addEventListener("click", clearJson);

    phaseFilter.addEventListener("change", renderMatchesList);
    sportFilter.addEventListener("input", renderMatchesList);
    matchFilter.addEventListener("input", renderMatchesList);
    clearMatchesBtn.addEventListener("click", clearMatches);

    window.addEventListener("error", (e) => {
        appLog("[window.error]", e.message, e.filename, e.lineno + ":" + e.colno);
    });

    window.addEventListener("unhandledrejection", (e) => {
        appLog("[unhandledrejection]", e.reason);
    });

    setStatus("Готово к подключению");
    appLog("[init] UI готов");

    if (window.__RE_STATE__.transportLogBuffer.length) {
        transportLogEl.textContent = window.__RE_STATE__.transportLogBuffer.join("\n") + "\n";
    }

    renderPacketHistory();
    renderJsonMessages();
    renderMatchesList();
    renderSelectedMatchEvents();
    updateBadges();
</script>
</body>
</html>