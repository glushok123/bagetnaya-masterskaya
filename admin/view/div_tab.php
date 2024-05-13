<?
$stm = $dbh->prepare("SELECT * FROM category_gallery_works");
$stm->execute();
$categoryGalleryWorkImages = $stm->fetchAll();

$categoryGalleryWorks = [];

foreach ($categoryGalleryWorkImages as $item) {
    $categoryGalleryWorks[$item['id']] = $item['name'];
}
?>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade row " id="plast" role="tabpanel" aria-labelledby="home-tab">

    </div>
    <div class="tab-pane fade row" id="wood" role="tabpanel" aria-labelledby="profile-tab">

    </div>
    <div class="tab-pane fade row" id="alum" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="pasp" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="promokod" role="tabpanel" aria-labelledby="contact-tab">
        <div class='container' id="promokod-container">

        </div>
    </div>
    <div class="tab-pane fade row" id="static" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="paintings" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="orders-paintings" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="feed-back" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="gallery-works" role="tabpanel" aria-labelledby="contact-tab">
        <div class='container'>
            <div class='container'>
                <div class="row">
                    <br>
                    <div class='col'>
                        <button type="button" class="btn btn-info add" data-bs-toggle="modal"
                                data-bs-target="#ModalAddGalleryWorks">Добавить
                        </button>
                    </div>
                    <div class='col'>
                        <select class="form-select" aria-label="Default select example" style="margin:10px;"
                                id='selectCategoryGalleryWorks'>
                            <?
                            foreach ($categoryGalleryWorks as $key => $value) {
                                echo '<option value="' . $key . '">' . $value . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="" style="width:100%">
                    <table id="gallery-works-tables" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Категория</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>