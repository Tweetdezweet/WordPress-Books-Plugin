<h3>Oxfam Secondhand books</h3>
<div class="oxfam-fixed">
    Isbn: <input id="scanned-isbn" name="scanned-isbn" type="text" value="" class="oxfam-scan" />
</div>
<div class="oxfam-dynamic oxfam-table-container">
    <table class="oxfam-table">
        <thead>
            <th>Title</th>
            <th>Authors</th>
            <th>Language</th>
            <th>Pagecount</th>
            <th>Has description</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div class="oxfam-dynamic oxfam-detail-container">
    <div class="oxfam-left-column">
        Title: <input type="text" id="oxfam-title" /><br />
        Subtitle: <input type="text" id="oxfam-subtitle" /><br />
        Authors: <input type="text" id="oxfam-authors" /><br />
        Description: <textarea class="oxfam-textarea" id="oxfam-description"></textarea>
    </div>
    <div class="oxfam-right-column">
        Language: <input type="text" id="oxfam-language" /><br />
        PageCount: <input type="text" id="oxfam-pagecount" /><br />
        Maturity rating: <input type="text" id="oxfam-maturityrating" /><br />
        Categories: <input type="text" id="oxfam-categories" /><br />
        Price: <input type="text" id="oxfam-price" />
    </div>
    <div class="oxfam-middle oxfam-confirm-container">
        <button class="oxfam-confirm-button" id="oxfam-confirm">Confirm</button>
    </div>
</div>