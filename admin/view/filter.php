<div class='container' id='dashbord-baget'>
    <div class='row text-center justify-content-center'>

        <button type="button" class="btn btn-info add" data-bs-toggle="modal" data-bs-target="#ModalAddCatalog">Добавить</button>
        <div class='container'>
            <div class='row justify-content-center'>
                <div class='col'>
                    <div class="input-group justify-content-center">
                        <input type="search" class="form-control rounded" placeholder="Артикул" aria-label="Search" aria-describedby="search-addon" id='searchId' />
                        <button type="button" class="btn btn-outline-primary">Поиск по артиклу</button>
                    </div>
                    <div class="input-group justify-content-center">
                        <input type="search" class="form-control rounded" placeholder="Цена" aria-label="Search" aria-describedby="search-addon" id='searchPrice' />
                        <button type="button" class="btn btn-outline-primary">Поиск по цене</button>
                    </div>
                </div>
                <div class='col'>
                    <div class="form-group">
                        <label for="sort">Сортировка:</label>
                        <select id="sort" class="form-control">
                            <option selected value=''>Выберите...</option>
                            <option value='priceDesc'>Цена &darr;</option>
                            <option value='priceAsc'>Цена &uarr;</option>
                            <option value='idDesc'>Артикул &darr;</option>
                            <option value='idAsc'>Артикул &uarr;</option>
                            <option value='countDesc'>Количество &darr;</option>
                            <option value='countAsc'>Количество &uarr;</option>
                            <option value='widthDesc'>Ширина &darr;</option>
                            <option value='widthAsc'>Ширина &uarr;</option>
                            <option value='widthwithoutDesc'>Без четверти &darr;</option>
                            <option value='widthwithoutAsc'>Без четверти &uarr;</option>
                        </select>
                    </div>
                </div>

            </div>
            <br>
        </div>

        <hr>
    </div>
</div>