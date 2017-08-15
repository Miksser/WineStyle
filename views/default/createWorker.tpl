<div class="container_worker">
    <div class="row header">
        <h1 style="color: black">Новый работник</h1>
    </div>
    <div class="row body">

        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="table" name="table" value="workers">
            <ul>
                <li>
                    <p class="left">
                        <label for="first_name">Имя</label>
                        <input type="text" name="first_name" id="first_name" value="">
                    </p>
                    <p class="pull-right">
                        <label for="second_name">Фамилия</label>
                        <input type="text" name="second_name" id="second_name" value="">
                    </p>
                </li>
                <li>
                    <p class="left">
                        <label for="salary">Оплата</label>
                        <input type="number" min="0" step="1" name="salary" id="salary" value="">
                    </p>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li>
                    <div class="control-group controlWorker">
                        <div class="select">
                            <label>Выберите профессию</label><br/>
                            <select id='position' name="position" multiple size="3">
                                {foreach $arProfessions as $item}
                                    <option value="{$item['id']}">{$item['name']}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </li>
                <li>
                    <div id="selectImage">
                        <label for="file">Выберите фото</label><br/>
                        <input type="file" name="file" id="file" required/>
                    </div>
                </li>
                <li>
                    <input class="button -regular center" type="submit" value="Отправить"/>
                </li>
            </ul>
        </form>

    </div>
</div>