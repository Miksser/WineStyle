<div id="calendar"></div>
<div class="info">
    <div class="container">
        <div class="control-group">
            <h1>Выбрать курс:</h1>
            <label class="control control--radio">RUB
                <input type="radio" name="Currency" id="RUB" checked="checked" value="RUB">
                <div class="control__indicator"></div>
            </label>
            <label class="control control--radio">USD
                <input type="radio" name="Currency" id="USD" value="USD">
                <div class="control__indicator"></div>
            </label>
        </div>

        <div class="control-group">
            <h1>Профессии</h1>

            <form action="?/" method="get">
                <input type="hidden" name="where[]" value="position">
                {foreach $arFilter as $item}
                    <label class="control control--checkbox">{$item['name']}
                        <input type="checkbox" name="position[]" value="{$item['id']}"
                               {if isset($CheckedStatus) && in_array($item['id'], $CheckedStatus )}checked{/if}>
                        <div class="control__indicator"></div>
                    </label>
                {/foreach}
                <input type="submit" class="button -regular center">
            </form>
        </div>

        <div class="control-group">
            <h1>Премия</h1>

            <form id="bonus" action="javascript:void(null);">
                <input type="number" name="bonusNumber" id="bonusNumber" required>
                <h4>увелчить в:</h4>
                <div class="select">
                    <select name="bonusType" id="chooseBonusType">
                        <option name="bonusPercent" id="bonusPercent" value="percent">Процентах</option>
                        <option name="bonusAmount" id="bonusAmount" value="amount">Сумме</option>
                    </select>
                </div>
                <input type="submit" class="button -regular center">
            </form>
        </div>
    </div>

    <div class="table-users">
        <div class="header-table">Рабочие</div>
        <table id="workers" cellpadding="0">
            <thead>
            <th>№</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Должность</th>
            <th>Зарплата</th>
            <th>Зарплата за месяц</th>
            <th>Фото</th>
            </thead>
            <tbody>
            {foreach $arWorkers as $item name = worker}
                <tr>
                    <td class="id" number='{$item['id']}'>
                        {$smarty.foreach.worker.iteration}
                    </td>
                    <td class="second_name">
                        {$item['second_name']}
                    </td>
                    <td class="first_name">
                        {$item['first_name']}
                    </td>
                    <td class="position">
                        {$item['position']}
                    </td>
                    <td class="salary">
                        {$item['salary']}
                    </td>
                    <td class="month" worker='{$item['id']}'>
                        {$item['month']}
                    </td>
                    <td class="photo">
                        <a class="fancybox" href="/upload/{$item['photo']}">
                            <img alt="Worker Photo" src="/upload/photo-ico/{$item['photo_ico']}"
                                 style="opacity: 1"></a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>


</div>