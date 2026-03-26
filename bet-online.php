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
        .panel.danger {
            border: 2px solid #e74c3c;
            background: #fff5f5;
        }
        .panel.danger h2 {
            color: #c0392b;
        }
        .danger-warn {
            background: #e74c3c;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .safe-badge {
            background: #27ae60;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 8px;
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
        button.btn-primary {
            background: #3498db;
            color: #fff;
            border-color: #2980b9;
        }
        button.btn-primary:hover {
            background: #2980b9;
        }
        button.btn-danger {
            background: #e74c3c;
            color: #fff;
            border-color: #c0392b;
        }
        button.btn-danger:hover {
            background: #c0392b;
        }
        button.btn-success {
            background: #27ae60;
            color: #fff;
            border-color: #219a52;
        }
        button.btn-success:hover {
            background: #219a52;
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
        .badge.green { background: #d4edda; border-color: #28a745; color: #155724; }
        .badge.red { background: #f8d7da; border-color: #dc3545; color: #721c24; }
        .badge.blue { background: #d1ecf1; border-color: #17a2b8; color: #0c5460; }
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
        .match-detail-line {
            font-size: 12px;
            color: #2c3e50;
            margin-top: 2px;
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
        .sub-status {
            font-size: 11px;
            color: #888;
            margin-top: 4px;
        }
        .sub-active {
            color: #27ae60;
            font-weight: bold;
        }
    </style>

    <script>
        /* ===== STATE ===== */
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
            manualStreams: new Set(),
            activeSubscriptions: new Set(),
            connectionState: "disconnected" // disconnected | connecting | connected | error
        };

        /* ===== UTILS ===== */
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

        /* ===== PACKET DECODE ===== */
        function __decodePacket(u8) {
            try {
                if (!(u8 instanceof Uint8Array) || u8.length < 2) {
                    return { kind: "unknown", note: "too short" };
                }

                // selector-subscribe: 00 5e 0a 06 [len] [?selector]
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

                // topic-subscribe: 00 03 [seq] [len] [>topicPath]
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
            if (window.__RE_STATE__.packetHistory.length > 500) {
                window.__RE_STATE__.packetHistory.length = 500;
            }
            if (typeof renderPacketHistory === "function") renderPacketHistory();
        }

        /* ===== WEBSOCKET HOOK (before diffusion.js) ===== */
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
                            __pushTransportLog(`[WS#${ws.__socketId}] IN TEXT`, ev.data.slice(0, 500));
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
                            __pushTransportLog(`[WS#${ws.__socketId}] OUT TEXT`, data.slice(0, 500));
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
    <span class="badge" id="connectionStateBadge">state: disconnected</span>
    <span class="badge" id="historyStatusBadge">history: 0</span>
    <span class="badge" id="jsonStatusBadge">json: 0</span>
    <span class="badge" id="matchesStatusBadge">matches: 0</span>
    <span class="badge" id="subsStatusBadge">subs: 0</span>
</div>

<!-- ===== CONNECTION + MATCH SUBSCRIPTION ===== -->
<div class="row">
    <div class="panel half">
        <div class="safe-badge">SDK / SAFE MODE</div>
        <h2>Подключение</h2>

        <label for="selectorInput">Широкий selector</label>
        <input id="selectorInput" type="text" value="?rdd/ui/bol//" />

        <div class="controls">
            <button id="connectBtn" class="btn-primary">Подключиться</button>
            <button id="selectBtn" class="btn-success">Стартовая подписка</button>
            <button id="connectAndSubscribeBtn" class="btn-primary">Подключиться + Подписаться</button>
            <button id="reloadBtn">Сбросить страницу</button>
        </div>

        <div class="sub-status" id="connectionSubStatus"></div>

        <div class="muted" style="margin-top:8px;">
            Порядок: 1) Подключиться, 2) Стартовая подписка. Или нажмите "Подключиться + Подписаться".<br>
            После подписки слева появится список реальных матчей по мере поступления данных.
        </div>
    </div>

    <div class="panel half">
        <div class="safe-badge">SDK / SAFE MODE</div>
        <h2>Подписка на выбранный матч</h2>

        <label for="fixtureIdInput">fixtureId</label>
        <input id="fixtureIdInput" type="text" placeholder="выбирается автоматически из списка" />

        <label for="selectedBaseTopicInput">Base topic (можно редактировать вручную)</label>
        <input id="selectedBaseTopicInput" type="text" placeholder="будет заполнен автоматически или введите вручную" />

        <div class="controls" style="margin-top:4px;">
            <button id="guessBaseTopicBtn">Попробовать найти baseTopic</button>
            <select id="guessPhaseSelect" style="width:auto;">
                <option value="live">live</option>
                <option value="upcoming" selected>upcoming</option>
            </select>
        </div>

        <div class="controls">
            <button id="subscribeAllBtn" class="btn-success">Подписаться на ВСЁ</button>
            <button id="subscribeBaseBtn">base</button>
            <button id="subscribeDetailBtn">detail</button>
            <button id="subscribeLobbyBtn">lobby</button>
            <button id="subscribeMostPopularBtn">most-popular</button>
            <button id="subscribeInsightsBtn">insights</button>
            <button id="subscribeMarketsBtn">markets</button>
        </div>

        <div class="sub-status" id="matchSubStatus"></div>

        <div class="muted" style="margin-top:8px;">
            Если baseTopic не найден автоматически, нажмите "Попробовать найти" или введите вручную.<br>
            Все подписки через SDK безопасны для сессии.
        </div>
    </div>
</div>

<!-- ===== MATCHES LIST + SELECTED MATCH ===== -->
<div class="row">
    <div class="panel left">
        <h2>Список матчей <span id="matchCountInline" class="muted"></span></h2>

        <div class="controls">
            <select id="phaseFilter">
                <option value="ALL">Все фазы</option>
                <option value="live">live</option>
                <option value="upcoming">upcoming</option>
                <option value="prematch">prematch</option>
                <option value="">(без фазы)</option>
            </select>

            <input id="sportFilter" type="text" placeholder="Фильтр по спорту" />
        </div>

        <div class="controls">
            <input id="matchFilter" type="text" placeholder="Поиск по league / fixtureId / topic" />
            <button id="clearMatchesBtn">Очистить</button>
        </div>

        <div id="matchesList" class="list" style="margin-top:8px;"></div>
    </div>

    <div class="panel right">
        <h2>Выбранный матч</h2>

        <div id="selectedMatchInfo" class="log" style="background:#f8f8f8;color:#222;border:1px solid #ddd;min-height:60px;"></div>

        <h3 style="margin-top:12px;">JSON-события по выбранному матчу <span id="selectedEventCount" class="muted"></span></h3>
        <div id="selectedMatchEvents" class="json-list"></div>
    </div>
</div>

<!-- ===== RAW / DANGER ZONE ===== -->
<div class="row">
    <div class="panel half danger">
        <div class="danger-warn">DANGER ZONE - Raw режим может сломать сессию!</div>
        <h2>Raw / Base64 отправка</h2>

        <label for="base64Input">Base64 пакета</label>
        <textarea id="base64Input"></textarea>

        <div class="controls">
            <button id="parseBase64Btn">Разобрать base64</button>
            <button id="sendBase64Btn" class="btn-danger">Отправить raw пакет</button>
        </div>

        <div class="muted" style="margin-top:6px;">
            Raw-отправка идёт напрямую в WebSocket, минуя SDK.
            Это может сломать протокол Diffusion и потребовать перезагрузки страницы.
        </div>

        <div id="builtPacketLog" class="log" style="margin-top:8px;"></div>
    </div>

    <div class="panel half">
        <h2>Лог приложения</h2>
        <div class="controls">
            <button id="clearAppLogBtn">Очистить</button>
        </div>
        <div id="appLog" class="log" style="margin-top:8px;"></div>
    </div>
</div>

<!-- ===== PACKET HISTORY ===== -->
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
                <option value="ascii">ascii</option>
                <option value="unknown">unknown</option>
            </select>
            <input id="historyFilterText" type="text" placeholder="Фильтр по selector/topic/base64/hex" />
            <button id="clearHistoryBtn">Очистить</button>
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

<!-- ===== TRANSPORT LOG + ALL JSON ===== -->
<div class="row">
    <div class="panel half">
        <h2>Лог транспорта</h2>
        <div class="controls">
            <button id="clearTransportLogBtn">Очистить</button>
        </div>
        <div id="transportLog" class="log" style="margin-top:8px;"></div>
    </div>

    <div class="panel half">
        <h2>Все входящие JSON <span id="jsonCountInline" class="muted"></span></h2>
        <div class="controls">
            <input id="jsonFilterText" type="text" placeholder="Фильтр по topic" />
            <button id="clearJsonBtn">Очистить</button>
        </div>
        <div id="items" class="json-list" style="margin-top:8px;"></div>
    </div>
</div>

<script>
    /* ===== DOM REFS ===== */
    const statusEl = document.getElementById("status");
    const appLogEl = document.getElementById("appLog");
    const transportLogEl = document.getElementById("transportLog");
    const itemsEl = document.getElementById("items");
    const builtPacketLogEl = document.getElementById("builtPacketLog");
    const matchesListEl = document.getElementById("matchesList");
    const selectedMatchInfoEl = document.getElementById("selectedMatchInfo");
    const selectedMatchEventsEl = document.getElementById("selectedMatchEvents");

    const socketStatusBadge = document.getElementById("socketStatusBadge");
    const connectionStateBadge = document.getElementById("connectionStateBadge");
    const historyStatusBadge = document.getElementById("historyStatusBadge");
    const jsonStatusBadge = document.getElementById("jsonStatusBadge");
    const matchesStatusBadge = document.getElementById("matchesStatusBadge");
    const subsStatusBadge = document.getElementById("subsStatusBadge");

    const matchCountInline = document.getElementById("matchCountInline");
    const selectedEventCount = document.getElementById("selectedEventCount");
    const jsonCountInline = document.getElementById("jsonCountInline");
    const connectionSubStatus = document.getElementById("connectionSubStatus");
    const matchSubStatus = document.getElementById("matchSubStatus");

    const selectorInput = document.getElementById("selectorInput");
    const fixtureIdInput = document.getElementById("fixtureIdInput");
    const selectedBaseTopicInput = document.getElementById("selectedBaseTopicInput");
    const base64Input = document.getElementById("base64Input");

    const phaseFilter = document.getElementById("phaseFilter");
    const sportFilter = document.getElementById("sportFilter");
    const matchFilter = document.getElementById("matchFilter");

    const connectBtn = document.getElementById("connectBtn");
    const selectBtn = document.getElementById("selectBtn");
    const connectAndSubscribeBtn = document.getElementById("connectAndSubscribeBtn");
    const reloadBtn = document.getElementById("reloadBtn");

    const subscribeAllBtn = document.getElementById("subscribeAllBtn");
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
    const clearAppLogBtn = document.getElementById("clearAppLogBtn");
    const clearTransportLogBtn = document.getElementById("clearTransportLogBtn");

    let session = null;

    /* ===== RENDER THROTTLE ===== */
    let _renderMatchesScheduled = false;
    let _renderJsonScheduled = false;
    let _renderSelectedScheduled = false;

    function scheduleRenderMatches() {
        if (_renderMatchesScheduled) return;
        _renderMatchesScheduled = true;
        requestAnimationFrame(() => { _renderMatchesScheduled = false; renderMatchesList(); });
    }
    function scheduleRenderJson() {
        if (_renderJsonScheduled) return;
        _renderJsonScheduled = true;
        requestAnimationFrame(() => { _renderJsonScheduled = false; renderJsonMessages(); });
    }
    function scheduleRenderSelected() {
        if (_renderSelectedScheduled) return;
        _renderSelectedScheduled = true;
        requestAnimationFrame(() => { _renderSelectedScheduled = false; renderSelectedMatchEvents(); });
    }

    /* ===== LOGGING ===== */
    function appLog(...args) {
        console.log(...args);
        appLogEl.textContent += args.map(__safeStringify).join(" ") + "\n";
        appLogEl.scrollTop = appLogEl.scrollHeight;
    }

    function setStatus(text) {
        statusEl.textContent = text;
    }

    function setConnectionState(state) {
        window.__RE_STATE__.connectionState = state;
        updateBadges();
    }

    /* ===== BADGES ===== */
    function updateBadges() {
        const ws = window.__RE_STATE__.realSocket;
        const readyStateNames = { 0: "CONNECTING", 1: "OPEN", 2: "CLOSING", 3: "CLOSED" };

        socketStatusBadge.textContent = ws
            ? `socket: #${ws.__socketId} ${readyStateNames[ws.readyState] || ws.readyState}`
            : "socket: none";
        socketStatusBadge.className = "badge" + (ws && ws.readyState === 1 ? " green" : ws ? " red" : "");

        const cState = window.__RE_STATE__.connectionState;
        connectionStateBadge.textContent = `state: ${cState}`;
        connectionStateBadge.className = "badge" + (cState === "connected" ? " green" : cState === "error" ? " red" : "");

        historyStatusBadge.textContent = `packets: ${window.__RE_STATE__.packetHistory.length}`;
        jsonStatusBadge.textContent = `json: ${window.__RE_STATE__.jsonMessages.length}`;
        jsonStatusBadge.className = "badge" + (window.__RE_STATE__.jsonMessages.length > 0 ? " blue" : "");

        const mSize = window.__RE_STATE__.matches.size;
        matchesStatusBadge.textContent = `matches: ${mSize}`;
        matchesStatusBadge.className = "badge" + (mSize > 0 ? " green" : "");

        subsStatusBadge.textContent = `subs: ${window.__RE_STATE__.activeSubscriptions.size}`;
        matchCountInline.textContent = `(${mSize})`;
        jsonCountInline.textContent = `(${window.__RE_STATE__.jsonMessages.length})`;
    }

    /* ===== UTILS ===== */
    function base64ToBytes(b64) {
        const clean = b64.replace(/\s+/g, "");
        return Uint8Array.from(atob(clean), c => c.charCodeAt(0));
    }

    function getRealSocket() {
        const ws = window.__RE_STATE__.realSocket;
        if (!ws || ws.readyState !== 1) return null;
        return ws;
    }

    function shortTarget(parsed) {
        if (!parsed || !parsed.kind) return "";
        if (parsed.kind === "selector-subscribe") return parsed.selector || "";
        if (parsed.kind === "topic-subscribe") return parsed.topicPath || parsed.topicString || "";
        if (parsed.kind === "ascii") return parsed.text ? parsed.text.slice(0, 80) : "";
        return parsed.note || "";
    }

    function escapeHtml(s) {
        return String(s)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;");
    }

    /* ===== PACKET HISTORY RENDER ===== */
    function renderPacketHistory() {
        const dir = historyFilterDirection.value;
        const kind = historyFilterKind.value;
        const text = historyFilterText.value.trim().toLowerCase();

        packetHistoryBody.innerHTML = "";

        const items = window.__RE_STATE__.packetHistory;
        let shown = 0;

        for (const entry of items) {
            if (shown >= 200) break;
            if (dir !== "ALL" && entry.direction !== dir) continue;
            if (kind !== "ALL" && (entry.parsed?.kind || "unknown") !== kind) continue;

            const haystack = [
                entry.hex, entry.base64, entry.ascii,
                entry.parsed?.selector, entry.parsed?.topicPath,
                entry.parsed?.topicString, entry.parsed?.kind
            ].filter(Boolean).join(" ").toLowerCase();

            if (text && !haystack.includes(text)) continue;

            const tr = document.createElement("tr");
            tr.className = "clickable-row";
            const dirColor = entry.direction === "OUT" ? "#e74c3c" : "#27ae60";
            tr.innerHTML = `
                <td>${entry.id}</td>
                <td>${entry.time.split("T")[1].replace("Z","").slice(0, 12)}</td>
                <td style="color:${dirColor};font-weight:bold">${entry.direction}</td>
                <td>#${entry.socketId}</td>
                <td>${entry.len}</td>
                <td>${entry.parsed?.kind || "unknown"}</td>
                <td>${escapeHtml(shortTarget(entry.parsed)).slice(0, 120)}</td>
                <td class="mono">${escapeHtml(entry.base64).slice(0, 60)}</td>
            `;
            tr.addEventListener("click", () => {
                base64Input.value = entry.base64;
                renderBuiltPacket("Пакет из истории", base64ToBytes(entry.base64));
            });
            packetHistoryBody.appendChild(tr);
            shown++;
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

    /* ===== JSON RENDER ===== */
    function renderJsonMessages() {
        const filter = jsonFilterText.value.trim().toLowerCase();
        itemsEl.innerHTML = "";

        let shown = 0;
        for (const entry of window.__RE_STATE__.jsonMessages) {
            if (shown >= 100) break;
            if (filter && !entry.topic.toLowerCase().includes(filter)) continue;

            const div = document.createElement("div");
            div.className = "json-item";
            div.innerHTML = `
                <div class="json-topic">${escapeHtml(entry.topic)}</div>
                <div class="small">${entry.time} | type: ${entry.dataType || "json"}</div>
                <pre style="white-space:pre-wrap;word-break:break-word;margin-top:8px;max-height:200px;overflow:auto;">${escapeHtml(JSON.stringify(entry.data, null, 2))}</pre>
            `;
            itemsEl.appendChild(div);
            shown++;
        }

        updateBadges();
    }

    /* ===== TOPIC PARSING ===== */
    function parseEventTopic(topic) {
        const parts = topic.split("/");
        if (parts.length < 6) return null;

        // rdd/ui/bol/event/live|upcoming/sport/.../fixtureId/...
        if (parts[0] === "rdd" && parts[1] === "ui" && parts[2] === "bol" && parts[3] === "event") {
            const phase = parts[4];
            const sport = parts[5];
            if (!["live", "upcoming"].includes(phase)) return null;

            const rest = parts.slice(6);
            let fixtureIdIndex = rest.findIndex(x => /^\d{3,}$/.test(x));
            if (fixtureIdIndex === -1) return null;

            const league = rest.slice(0, fixtureIdIndex).join("/");
            const fixtureId = rest[fixtureIdIndex];
            const tail = rest.slice(fixtureIdIndex + 1);
            const baseTopic = ["rdd", "ui", "bol", "event", phase, sport].concat(
                league ? [league, fixtureId] : [fixtureId]
            ).join("/");

            return { family: "event", phase, sport, league, fixtureId, baseTopic, tail };
        }

        // rdd/ui/bol/prematch/event/sport/.../fixtureId/...
        if (parts[0] === "rdd" && parts[1] === "ui" && parts[2] === "bol" && parts[3] === "prematch" && parts[4] === "event") {
            const phase = "prematch";
            const sport = parts[5];
            const rest = parts.slice(6);
            let fixtureIdIndex = rest.findIndex(x => /^\d{3,}$/.test(x));
            if (fixtureIdIndex === -1) return null;

            const league = rest.slice(0, fixtureIdIndex).join("/");
            const fixtureId = rest[fixtureIdIndex];
            const tail = rest.slice(fixtureIdIndex + 1);
            const baseTopic = ["rdd", "ui", "bol", "prematch", "event", sport].concat(
                league ? [league, fixtureId] : [fixtureId]
            ).join("/");

            return { family: "prematch-event", phase, sport, league, fixtureId, baseTopic, tail };
        }

        // rdd/ui/bol/views/calendar/upcoming/sport/league/fixtureId/date
        // Example: rdd/ui/bol/views/calendar/upcoming/soccer/China - Chinese Super League/1504202/2026-03-21T13:00:00
        if (parts[0] === "rdd" && parts[1] === "ui" && parts[2] === "bol" && parts[3] === "views" && parts[4] === "calendar") {
            const phase = parts[5]; // upcoming, live, etc.
            const sport = parts[6];
            if (!sport) return null;
            const rest = parts.slice(7);
            let fixtureIdIndex = rest.findIndex(x => /^\d{3,}$/.test(x));
            if (fixtureIdIndex === -1) return null;

            const league = rest.slice(0, fixtureIdIndex).join("/");
            const fixtureId = rest[fixtureIdIndex];
            const tail = rest.slice(fixtureIdIndex + 1);
            // For views/calendar, construct an event baseTopic (try to find it later)
            const baseTopic = ["rdd", "ui", "bol", "event", phase, sport].concat(
                league ? [league, fixtureId] : [fixtureId]
            ).join("/");

            return { family: "calendar-view", phase, sport, league, fixtureId, baseTopic, tail };
        }

        return null;
    }

    /* ===== MATCH EXTRACTION (from JSON data content) ===== */

    // Parse title like "Team A v Team B" or "Team A vs Team B"
    function parseTitleTeams(title) {
        if (!title || typeof title !== "string") return null;
        const m = title.match(/^(.+?)\s+(?:v|vs\.?)\s+(.+)$/i);
        if (m) return { home: m[1].trim(), away: m[2].trim() };
        return null;
    }

    // Guess sport from bet description keywords
    function guessSportFromLegs(legs) {
        if (!Array.isArray(legs) || legs.length === 0) return "";
        const text = legs.map(l => l.description || "").join(" ").toLowerCase();
        if (text.includes("goal") || text.includes("corner") || text.includes("half time") || text.includes("90 min")) return "soccer";
        if (text.includes("point") && (text.includes("quarter") || text.includes("rebound") || text.includes("assist") || text.includes("three pointer"))) return "basketball";
        if (text.includes("set") && text.includes("game")) return "tennis";
        if (text.includes("run") && text.includes("inning")) return "baseball";
        if (text.includes("touchdown") || text.includes("yard")) return "football";
        if (text.includes("period") && text.includes("goal")) return "hockey";
        if (text.includes("round")) return "mma/boxing";
        return "";
    }

    // Main: ensure match exists in the map, creating/updating from whatever data we have
    function ensureMatch(fixtureId, info) {
        const fid = String(fixtureId);
        let match = window.__RE_STATE__.matches.get(fid);
        if (!match) {
            match = {
                fixtureId: fid,
                title: "",
                home: "",
                away: "",
                sport: "",
                league: "",
                phase: "",
                baseTopic: "",
                sourceTopics: new Set(),
                relatedTopics: new Set(),
                lastSeen: null,
                messageCount: 0,
                betCount: 0,
                legs: []
            };
            window.__RE_STATE__.matches.set(fid, match);
        }

        if (info.title && !match.title) match.title = info.title;
        if (info.home) match.home = info.home;
        if (info.away) match.away = info.away;
        if (info.sport && !match.sport) match.sport = info.sport;
        if (info.league && !match.league) match.league = info.league;
        if (info.phase && !match.phase) match.phase = info.phase;
        if (info.baseTopic && !match.baseTopic) match.baseTopic = info.baseTopic;
        if (info.sourceTopic) match.sourceTopics.add(info.sourceTopic);
        if (info.legs) match.legs = info.legs;
        match.lastSeen = new Date().toISOString();
        match.messageCount++;

        return match;
    }

    // Extract matches from a bet-group JSON (has bets[] array)
    function extractMatchesFromBetGroup(topic, data) {
        if (!data || !Array.isArray(data.bets)) return 0;
        let count = 0;

        for (const bet of data.bets) {
            if (!bet.fixtureId) continue;
            const teams = parseTitleTeams(bet.title);
            const sport = guessSportFromLegs(bet.legs);

            ensureMatch(bet.fixtureId, {
                title: bet.title || "",
                home: teams ? teams.home : "",
                away: teams ? teams.away : "",
                sport: sport,
                sourceTopic: topic,
                legs: (bet.legs || []).map(l => l.description || "")
            });
            count++;
        }
        return count;
    }

    // Extract matches from event-style JSON (has fixtureId at top level)
    function extractMatchFromEventData(topic, data) {
        if (!data || typeof data !== "object") return false;

        // Direct fixtureId field
        let fid = data.fixtureId || data.fixture_id || data.id;
        if (!fid && data.fixture) fid = data.fixture.id || data.fixture.fixtureId;
        if (!fid) return false;

        const info = { sourceTopic: topic };

        // Title
        if (data.title) info.title = data.title;
        else if (data.name) info.title = data.name;
        else if (data.fixture && data.fixture.name) info.title = data.fixture.name;

        // Teams
        if (data.homeTeam && data.awayTeam) { info.home = data.homeTeam; info.away = data.awayTeam; }
        else if (data.home && data.away) { info.home = data.home; info.away = data.away; }
        else if (data.fixture) {
            if (data.fixture.homeTeam) info.home = data.fixture.homeTeam;
            if (data.fixture.awayTeam) info.away = data.fixture.awayTeam;
        }
        else if (data.participants && Array.isArray(data.participants) && data.participants.length >= 2) {
            info.home = data.participants[0]?.name || String(data.participants[0]);
            info.away = data.participants[1]?.name || String(data.participants[1]);
        }

        // If we have a title but no teams, parse from title
        if (info.title && !info.home) {
            const teams = parseTitleTeams(info.title);
            if (teams) { info.home = teams.home; info.away = teams.away; }
        }

        // Sport / League / Phase
        if (data.sport) info.sport = typeof data.sport === "string" ? data.sport : (data.sport.name || "");
        if (data.league) info.league = typeof data.league === "string" ? data.league : (data.league.name || "");
        if (data.competition) info.league = typeof data.competition === "string" ? data.competition : (data.competition.name || "");
        if (data.phase) info.phase = data.phase;
        if (data.status) info.phase = data.status;

        ensureMatch(fid, info);
        return true;
    }

    // Extract from topic path (event/live/... or prematch/event/...)
    function extractMatchFromTopicPath(topic, data) {
        const info = parseEventTopic(topic);
        if (!info) return false;

        const matchInfo = {
            sport: info.sport,
            league: info.league,
            phase: info.phase,
            baseTopic: info.baseTopic,
            sourceTopic: topic
        };

        // Also extract from data if available
        if (data && typeof data === "object") {
            if (data.title || data.name) matchInfo.title = data.title || data.name;
            const teams = parseTitleTeams(matchInfo.title);
            if (teams) { matchInfo.home = teams.home; matchInfo.away = teams.away; }
        }

        ensureMatch(info.fixtureId, matchInfo);
        return true;
    }

    // Deep scan: look for fixtureId anywhere in nested data
    function deepScanForFixtures(topic, data, depth) {
        if (depth > 3 || !data || typeof data !== "object") return;

        if (Array.isArray(data)) {
            for (const item of data) {
                deepScanForFixtures(topic, item, depth + 1);
            }
            return;
        }

        // If this object has a fixtureId, register it
        if (data.fixtureId || data.fixture_id) {
            extractMatchFromEventData(topic, data);
        }

        // Check nested arrays/objects
        for (const key of Object.keys(data)) {
            const val = data[key];
            if (Array.isArray(val) || (val && typeof val === "object")) {
                deepScanForFixtures(topic, val, depth + 1);
            }
        }
    }

    // Master function: process incoming JSON and extract all matches
    function processJsonForMatches(topic, data) {
        if (!data || typeof data !== "object") return;

        // 1. Try topic path extraction (event/live/..., prematch/event/...)
        extractMatchFromTopicPath(topic, data);

        // 2. Try bet-group extraction (bets[] array)
        if (Array.isArray(data.bets) && data.bets.length > 0) {
            extractMatchesFromBetGroup(topic, data);
            return; // bets[] already covers all fixtures in this message
        }

        // 3. Try direct fixtureId extraction
        if (data.fixtureId || data.fixture_id) {
            extractMatchFromEventData(topic, data);
            return;
        }

        // 4. Deep scan for any nested fixtureId references (fixtures, events, etc.)
        deepScanForFixtures(topic, data, 0);
    }

    /* ===== MATCHES LIST RENDER ===== */
    function renderMatchesList() {
        const phase = phaseFilter.value;
        const sportText = sportFilter.value.trim().toLowerCase();
        const text = matchFilter.value.trim().toLowerCase();

        const arr = Array.from(window.__RE_STATE__.matches.values())
            .sort((a, b) => {
                // Sort: by sport, then by title/fixtureId
                if (a.sport !== b.sport) {
                    if (!a.sport) return 1;
                    if (!b.sport) return -1;
                    return a.sport.localeCompare(b.sport);
                }
                if (a.phase !== b.phase) {
                    const order = { live: 0, upcoming: 1, prematch: 2 };
                    return (order[a.phase] ?? 3) - (order[b.phase] ?? 3);
                }
                return (a.title || a.fixtureId).localeCompare(b.title || b.fixtureId);
            });

        matchesListEl.innerHTML = "";

        let count = 0;
        for (const m of arr) {
            if (phase !== "ALL" && (m.phase || "") !== phase) continue;
            if (sportText && !(m.sport || "").toLowerCase().includes(sportText)) continue;

            const hay = [m.fixtureId, m.title, m.home, m.away, m.phase, m.sport, m.league, m.baseTopic]
                .filter(Boolean).join(" ").toLowerCase();
            if (text && !hay.includes(text)) continue;

            count++;

            const div = document.createElement("div");
            const isActive = window.__RE_STATE__.selectedFixtureId === m.fixtureId;
            div.className = "match-item" + (isActive ? " active" : "");

            // Title line: team names or fixture title
            let titleLine = "";
            if (m.home && m.away) {
                titleLine = `${escapeHtml(m.home)} vs ${escapeHtml(m.away)}`;
            } else if (m.title) {
                titleLine = escapeHtml(m.title);
            } else {
                titleLine = `Fixture #${escapeHtml(m.fixtureId)}`;
            }

            // Meta line
            const metaParts = [`id: ${escapeHtml(m.fixtureId)}`];
            if (m.sport) metaParts.push(escapeHtml(m.sport));
            if (m.phase) metaParts.push(`<b>${escapeHtml(m.phase)}</b>`);
            if (m.league) metaParts.push(escapeHtml(m.league));
            metaParts.push(m.baseTopic
                ? '<span style="color:#27ae60">has baseTopic</span>'
                : '<span style="color:#e67e22">bet-group only</span>');

            div.innerHTML = `
                <div class="match-title">${titleLine}</div>
                <div class="match-meta">${metaParts.join(" | ")}</div>
            `;
            div.addEventListener("click", () => selectMatch(m.fixtureId));
            matchesListEl.appendChild(div);
        }

        matchCountInline.textContent = `(${count}/${window.__RE_STATE__.matches.size})`;
        updateBadges();
    }

    /* ===== MATCH SELECTION ===== */
    function selectMatch(fixtureId) {
        window.__RE_STATE__.selectedFixtureId = String(fixtureId);
        const m = window.__RE_STATE__.matches.get(String(fixtureId));
        if (!m) return;

        fixtureIdInput.value = m.fixtureId;
        if (m.baseTopic) {
            selectedBaseTopicInput.value = m.baseTopic;
        } else {
            // Auto-construct a guess based on what we know
            const sport = m.sport || "basketball";
            const guessedBase = `rdd/ui/bol/event/upcoming/${sport}`;
            selectedBaseTopicInput.value = "";
            selectedBaseTopicInput.placeholder = `Not found yet. Try: ${guessedBase}/LEAGUE/${m.fixtureId}`;
        }

        selectedMatchInfoEl.textContent = JSON.stringify({
            fixtureId: m.fixtureId,
            title: m.title,
            home: m.home,
            away: m.away,
            sport: m.sport,
            league: m.league,
            phase: m.phase,
            baseTopic: m.baseTopic || null,
            sourceTopics: Array.from(m.sourceTopics),
            legs: m.legs,
            messageCount: m.messageCount
        }, null, 2);

        renderMatchesList();
        renderSelectedMatchEvents();
        appLog("[match selected]", m.fixtureId, m.title || m.home + " vs " + m.away);
    }

    function renderSelectedMatchEvents() {
        selectedMatchEventsEl.innerHTML = "";
        const fixtureId = window.__RE_STATE__.selectedFixtureId;
        if (!fixtureId) {
            selectedEventCount.textContent = "";
            return;
        }

        const match = window.__RE_STATE__.matches.get(fixtureId);
        const sourceTopics = match ? match.sourceTopics : new Set();

        // Filter messages that mention this fixtureId
        const filtered = window.__RE_STATE__.jsonMessages.filter(x => {
            // Check source topics
            if (sourceTopics.has(x.topic)) return true;
            // Check if topic path contains fixtureId
            if (x.topic.includes(`/${fixtureId}`)) return true;
            // Check if JSON data mentions this fixtureId
            if (x._fixtureIds && x._fixtureIds.has(fixtureId)) return true;
            return false;
        });

        selectedEventCount.textContent = `(${filtered.length})`;

        for (const entry of filtered.slice(0, 80)) {
            const div = document.createElement("div");
            div.className = "json-item";
            div.innerHTML = `
                <div class="json-topic">${escapeHtml(entry.topic)}</div>
                <div class="small">${entry.time} | type: ${entry.dataType || "json"}</div>
                <pre style="white-space:pre-wrap;word-break:break-word;margin-top:8px;max-height:200px;overflow:auto;">${escapeHtml(JSON.stringify(entry.data, null, 2))}</pre>
            `;
            selectedMatchEventsEl.appendChild(div);
        }
    }

    /* ===== RECORD JSON ===== */
    function collectFixtureIds(data) {
        const ids = new Set();
        function scan(obj, depth) {
            if (depth > 4 || !obj || typeof obj !== "object") return;
            if (Array.isArray(obj)) {
                for (const item of obj) scan(item, depth + 1);
                return;
            }
            if (obj.fixtureId) ids.add(String(obj.fixtureId));
            if (obj.fixture_id) ids.add(String(obj.fixture_id));
            for (const key of Object.keys(obj)) {
                const v = obj[key];
                if (v && typeof v === "object") scan(v, depth + 1);
            }
        }
        scan(data, 0);
        return ids;
    }

    function recordJson(topic, data, dataType) {
        const fixtureIds = collectFixtureIds(data);

        window.__RE_STATE__.jsonMessages.unshift({
            time: new Date().toISOString(),
            topic,
            data,
            dataType: dataType || "json",
            _fixtureIds: fixtureIds
        });
        if (window.__RE_STATE__.jsonMessages.length > 500) {
            window.__RE_STATE__.jsonMessages.length = 500;
        }

        // Extract matches from this JSON
        processJsonForMatches(topic, data);

        scheduleRenderJson();
        scheduleRenderMatches();
        scheduleRenderSelected();
    }

    /* ===== SDK CONNECTION ===== */
    async function connect() {
        if (!window.diffusion) {
            setStatus("diffusion SDK not loaded");
            appLog("[error] diffusion SDK not loaded - check network/CDN");
            return;
        }

        if (session) {
            appLog("[info] session already exists");
            updateBadges();
            return;
        }

        try {
            setConnectionState("connecting");
            setStatus("Connecting...");
            connectionSubStatus.textContent = "connecting to api.betonline.ag ...";

            session = await diffusion.connect({
                host: "api.betonline.ag",
                port: 443,
                secure: true,
                path: "/pushd"
            });

            setConnectionState("connected");
            setStatus("Connected");
            connectionSubStatus.innerHTML = '<span class="sub-active">session active</span>';
            appLog("[connected] session created, sessionId:", session.sessionId || "N/A");
            updateBadges();

            // Session event listeners (individual calls for diffusion 6.9 compat)
            try {
                session.on("disconnect", function(reason) {
                    appLog("[disconnect]", reason);
                    setConnectionState("disconnected");
                    connectionSubStatus.textContent = "disconnected: " + (reason || "unknown");
                    updateBadges();
                });
            } catch(e) { /* listener not supported */ }

            try {
                session.on("error", function(err) {
                    appLog("[session error]", err);
                    setConnectionState("error");
                    updateBadges();
                });
            } catch(e) { /* listener not supported */ }

            try {
                session.on("reconnect", function() {
                    appLog("[reconnect]");
                    setConnectionState("connected");
                    connectionSubStatus.innerHTML = '<span class="sub-active">reconnected</span>';
                    updateBadges();
                });
            } catch(e) { /* listener not supported */ }

            try {
                session.on("close", function(reason) {
                    appLog("[close]", reason);
                    setConnectionState("disconnected");
                    connectionSubStatus.textContent = "closed: " + (reason || "");
                    session = null;
                    updateBadges();
                });
            } catch(e) { /* listener not supported */ }

        } catch (e) {
            appLog("[connect failed]", e);
            setStatus("Connection failed");
            setConnectionState("error");
            connectionSubStatus.textContent = "failed: " + String(e.message || e);
            updateBadges();
        }
    }

    /* ===== SDK STREAMS & SUBSCRIBE ===== */
    // Track ALL subscribed topics for baseTopic discovery
    if (!window.__RE_STATE__._allSubscribedTopics) {
        window.__RE_STATE__._allSubscribedTopics = new Set();
    }

    function onTopicSubscribed(topic) {
        window.__RE_STATE__._allSubscribedTopics.add(topic);

        // Try to extract baseTopic from this topic path
        const info = parseEventTopic(topic);
        if (info) {
            const fid = info.fixtureId;
            const existing = window.__RE_STATE__.matches.get(fid);
            if (existing && !existing.baseTopic) {
                // We found a baseTopic for a match that was previously bet-group only!
                existing.baseTopic = info.baseTopic;
                existing.sport = existing.sport || info.sport;
                existing.league = existing.league || info.league;
                existing.phase = existing.phase || info.phase;
                existing.sourceTopics.add(topic);
                appLog("[auto-discovered baseTopic]", fid, "→", info.baseTopic);

                // If this match is currently selected, update the UI
                if (window.__RE_STATE__.selectedFixtureId === fid) {
                    selectedBaseTopicInput.value = info.baseTopic;
                    matchSubStatus.innerHTML = '<span class="sub-active">baseTopic auto-discovered: ' + escapeHtml(info.baseTopic) + '</span>';
                }
                scheduleRenderMatches();
            } else if (!existing) {
                // New match from topic path
                ensureMatch(fid, {
                    sport: info.sport, league: info.league,
                    phase: info.phase, baseTopic: info.baseTopic,
                    sourceTopic: topic
                });
                scheduleRenderMatches();
            }
        }
    }

    function registerJsonStream(selector) {
        if (window.__RE_STATE__.manualStreams.has("json:" + selector)) return;
        window.__RE_STATE__.manualStreams.add("json:" + selector);

        try {
            session
                .addStream(selector, diffusion.datatypes.json())
                .on("value", function(topic, spec, newValue, oldValue) {
                    try {
                        const data = newValue.get();
                        recordJson(topic, data, "json");
                    } catch (err) {
                        appLog("[json stream error]", topic, err);
                    }
                })
                .on("subscribe", function(topic, spec) {
                    appLog("[json subscribed]", topic);
                    onTopicSubscribed(topic);
                })
                .on("unsubscribe", function(topic, spec, reason) {
                    appLog("[json unsubscribed]", topic, reason);
                });
            appLog("[stream registered] json:", selector);
        } catch (e) {
            appLog("[stream register error] json:", selector, e);
        }
    }

    function registerStringStream(selector) {
        if (window.__RE_STATE__.manualStreams.has("string:" + selector)) return;
        window.__RE_STATE__.manualStreams.add("string:" + selector);

        try {
            session
                .addStream(selector, diffusion.datatypes.string())
                .on("value", function(topic, spec, newValue, oldValue) {
                    try {
                        const str = newValue.get();
                        let data;
                        try { data = JSON.parse(str); } catch { data = str; }
                        recordJson(topic, data, "string");
                    } catch (err) {
                        appLog("[string stream error]", topic, err);
                    }
                })
                .on("subscribe", function(topic) {
                    appLog("[string subscribed]", topic);
                });
            appLog("[stream registered] string:", selector);
        } catch (e) {
            appLog("[stream register error] string:", selector, e);
        }
    }

    function registerBinaryStream(selector) {
        if (window.__RE_STATE__.manualStreams.has("binary:" + selector)) return;
        window.__RE_STATE__.manualStreams.add("binary:" + selector);

        try {
            session
                .addStream(selector, diffusion.datatypes.binary())
                .on("value", function(topic, spec, newValue, oldValue) {
                    try {
                        const buf = newValue.get();
                        let data;
                        try {
                            const text = new TextDecoder().decode(buf);
                            data = JSON.parse(text);
                        } catch {
                            data = { _binary: true, _length: buf ? buf.byteLength || buf.length : 0 };
                        }
                        recordJson(topic, data, "binary");
                    } catch (err) {
                        appLog("[binary stream error]", topic, err);
                    }
                });
            appLog("[stream registered] binary:", selector);
        } catch (e) {
            appLog("[stream register error] binary:", selector, e);
        }
    }

    async function sdkSubscribe(selector) {
        if (!session) {
            appLog("[error] session not created yet - connect first");
            setStatus("Connect first");
            return;
        }

        try {
            appLog("[sdk subscribe start]", selector);
            connectionSubStatus.textContent = "subscribing: " + selector;

            // Register streams for all data types
            registerJsonStream(selector);
            registerStringStream(selector);
            registerBinaryStream(selector);

            await session.select(selector);
            window.__RE_STATE__.activeSubscriptions.add(selector);

            setStatus("Subscribed: " + selector);
            connectionSubStatus.innerHTML = '<span class="sub-active">subscribed: ' + escapeHtml(selector) + '</span>';
            appLog("[sdk subscribe ok]", selector);
            updateBadges();
        } catch (e) {
            appLog("[sdk subscribe failed]", selector, e);
            connectionSubStatus.textContent = "subscribe failed: " + String(e.message || e);
        }
    }

    /* ===== MATCH SUBSCRIPTION ===== */

    // Get the effective baseTopic: from input field (user can edit), or from match data
    function getEffectiveBaseTopic() {
        const fromInput = selectedBaseTopicInput.value.trim();
        if (fromInput && fromInput.startsWith("rdd/")) return fromInput;
        return null;
    }

    // Build selectors using the effective baseTopic
    function buildSelectorsFromBaseTopic(baseTopic) {
        return {
            base: `?${baseTopic}`,
            detail: `?${baseTopic}/detail`,
            lobby: `?${baseTopic}/market-group/lobby`,
            mostPopular: `?${baseTopic}/market-group/most-popular`,
            insights: `?${baseTopic}/insights`,
            markets: `>${baseTopic}/markets/`
        };
    }

    // Try to discover baseTopic by scanning all known subscribed topics
    // and trying targeted selectors
    async function guessBaseTopic() {
        const fixtureId = fixtureIdInput.value.trim();
        if (!fixtureId) {
            appLog("[discover] no fixtureId selected");
            return;
        }

        // 1. Check if already discovered
        const m = window.__RE_STATE__.matches.get(fixtureId);
        if (m && m.baseTopic) {
            selectedBaseTopicInput.value = m.baseTopic;
            appLog("[discover] baseTopic already known:", m.baseTopic);
            matchSubStatus.innerHTML = '<span class="sub-active">baseTopic: ' + escapeHtml(m.baseTopic) + '</span>';
            return;
        }

        // 2. Scan ALL known subscribed topics for this fixtureId
        const allTopics = window.__RE_STATE__._allSubscribedTopics || new Set();
        for (const t of allTopics) {
            if (t.includes("/" + fixtureId)) {
                const info = parseEventTopic(t);
                if (info) {
                    ensureMatch(fixtureId, {
                        sport: info.sport, league: info.league,
                        phase: info.phase, baseTopic: info.baseTopic,
                        sourceTopic: t
                    });
                    selectedBaseTopicInput.value = info.baseTopic;
                    appLog("[discover] found baseTopic from known topics:", info.baseTopic);
                    matchSubStatus.innerHTML = '<span class="sub-active">baseTopic: ' + escapeHtml(info.baseTopic) + '</span>';
                    return;
                }
            }
        }

        // 3. Try targeted subscriptions to discover
        const phase = document.getElementById("guessPhaseSelect").value;
        const sport = (m && m.sport) || "basketball";
        const phases = [phase, phase === "live" ? "upcoming" : "live", "prematch"];
        const sportGuesses = [sport];
        // Add common sport name variants
        if (sport === "basketball") sportGuesses.push("basketball");
        if (sport === "soccer") sportGuesses.push("soccer", "football");

        matchSubStatus.textContent = `Searching event topics for fixture ${fixtureId}...`;
        appLog("[discover] scanning for fixtureId:", fixtureId, "sport:", sport);

        let found = false;
        for (const ph of phases) {
            if (found) break;
            for (const sp of sportGuesses) {
                if (found) break;
                const searchSelector = `>rdd/ui/bol/event/${ph}/${sp}/`;
                try {
                    appLog("[discover] trying:", searchSelector);
                    registerJsonStream(searchSelector);
                    await session.select(searchSelector);
                    window.__RE_STATE__.activeSubscriptions.add(searchSelector);

                    // Wait and check
                    await new Promise(r => setTimeout(r, 2000));
                    const updated = window.__RE_STATE__.matches.get(fixtureId);
                    if (updated && updated.baseTopic) {
                        selectedBaseTopicInput.value = updated.baseTopic;
                        appLog("[discover] baseTopic found:", updated.baseTopic);
                        matchSubStatus.innerHTML = '<span class="sub-active">baseTopic: ' + escapeHtml(updated.baseTopic) + '</span>';
                        found = true;
                    }
                } catch (e) {
                    appLog("[discover] failed for", searchSelector, e.message || e);
                }
            }
        }

        if (!found) {
            // This match only exists in bet-group data, no dedicated event topic
            matchSubStatus.textContent = `No event topic found for fixture ${fixtureId}. This match exists only in bet-group data. ` +
                `You can still view its data from bet-group messages below.`;
            appLog("[discover] no event topic found — match is bet-group only");
        }
    }

    async function subscribeSelected(kind) {
        const baseTopic = getEffectiveBaseTopic();
        if (!baseTopic) {
            matchSubStatus.textContent = 'Enter baseTopic in the field above, or use "Попробовать найти baseTopic".';
            appLog("[error] no baseTopic — enter one manually or use discover button");
            return;
        }
        const selectors = buildSelectorsFromBaseTopic(baseTopic);
        const selector = selectors[kind];
        if (!selector) throw new Error("Unknown subscription kind: " + kind);
        matchSubStatus.textContent = `subscribing ${kind}: ${selector}`;
        await sdkSubscribe(selector);
        matchSubStatus.innerHTML = `<span class="sub-active">${kind}: ${escapeHtml(selector)}</span>`;
    }

    async function subscribeAll() {
        const baseTopic = getEffectiveBaseTopic();
        if (!baseTopic) {
            matchSubStatus.textContent = 'Enter baseTopic first, or use "Попробовать найти baseTopic".';
            appLog("[error] no baseTopic for subscribeAll");
            return;
        }
        const selectors = buildSelectorsFromBaseTopic(baseTopic);
        matchSubStatus.textContent = "subscribing all...";

        for (const [kind, selector] of Object.entries(selectors)) {
            try {
                await sdkSubscribe(selector);
                appLog(`[subscribe all] ${kind} ok`);
            } catch (e) {
                appLog(`[subscribe all] ${kind} failed:`, e);
            }
        }

        matchSubStatus.innerHTML = '<span class="sub-active">all subscriptions active</span>';
    }

    /* ===== CONNECT + SUBSCRIBE ===== */
    async function connectAndSubscribe() {
        await connect();
        if (!session) return;
        // Small delay for session to stabilize
        await new Promise(r => setTimeout(r, 500));
        await sdkSubscribe(selectorInput.value.trim());
    }

    /* ===== RAW / BASE64 ===== */
    function parseBase64Packet() {
        try {
            const u8 = base64ToBytes(base64Input.value);
            renderBuiltPacket("Parsed base64 packet", u8);
        } catch (e) {
            appLog("[base64 parse failed]", e);
        }
    }

    function sendRawBase64() {
        const ws = getRealSocket();
        if (!ws) {
            appLog("[error] WebSocket not ready (readyState != OPEN)");
            return;
        }

        if (!confirm("WARNING: Sending raw packets can break the Diffusion session.\nYou may need to reload the page after this.\n\nContinue?")) {
            return;
        }

        try {
            const u8 = base64ToBytes(base64Input.value);
            appLog("[raw send]", {
                socketId: ws.__socketId,
                len: u8.length,
                parsed: __decodePacket(u8),
                base64: __bytesToBase64(u8)
            });
            ws.send(u8);
            appLog("[raw send] done - watch for response or errors");
        } catch (e) {
            appLog("[raw send failed]", e);
        }
    }

    /* ===== CLEAR ACTIONS ===== */
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

    /* ===== EVENT LISTENERS ===== */
    connectBtn.addEventListener("click", connect);
    selectBtn.addEventListener("click", () => sdkSubscribe(selectorInput.value.trim()));
    connectAndSubscribeBtn.addEventListener("click", connectAndSubscribe);
    reloadBtn.addEventListener("click", () => location.reload());

    document.getElementById("guessBaseTopicBtn").addEventListener("click", async () => {
        try { await guessBaseTopic(); } catch (e) { appLog("[guess error]", e); }
    });

    subscribeAllBtn.addEventListener("click", async () => { try { await subscribeAll(); } catch (e) { appLog(e); matchSubStatus.textContent = String(e.message || e); } });
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

    clearAppLogBtn.addEventListener("click", () => { appLogEl.textContent = ""; });
    clearTransportLogBtn.addEventListener("click", () => { transportLogEl.textContent = ""; });

    /* ===== ERROR HANDLERS ===== */
    window.addEventListener("error", (e) => {
        appLog("[window.error]", e.message, e.filename, e.lineno + ":" + e.colno);
    });

    window.addEventListener("unhandledrejection", (e) => {
        appLog("[unhandledrejection]", e.reason);
    });

    /* ===== INIT ===== */
    setStatus("Ready");
    appLog("[init] UI ready");
    appLog("[init] Workflow: Connect -> Start subscription -> Wait for matches -> Select match -> Subscribe to match topics");

    if (window.__RE_STATE__.transportLogBuffer.length) {
        transportLogEl.textContent = window.__RE_STATE__.transportLogBuffer.join("\n") + "\n";
    }

    renderPacketHistory();
    renderJsonMessages();
    renderMatchesList();
    renderSelectedMatchEvents();
    updateBadges();

    // Periodic badge update (socket state can change externally)
    setInterval(updateBadges, 3000);
</script>
</body>
</html>
