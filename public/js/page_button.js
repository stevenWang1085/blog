/**
 * 建立選頁按鈕
 * @param {object} data - 整體資料
 * @param {object} data.return_data - API回傳資料
 * @param {int} data.return_data.last_page - 最後一頁位於第幾頁
 * @param {int} data.return_data.current_page - 目前位於第幾頁
 * @param {string} function_name - 用來刷新的函式
 * @param {string} action_current_page - 另指定頁次欄位
 * @param {string} action_last_page - 另指定頁次欄位
 * @param {string} action_page_buttons - 另指定頁次欄位
 */
function buildPageButtons(data, function_name, action_current_page, action_last_page, action_page_buttons) {
    if (!action_current_page) {
        action_current_page = null;
    }
    if (!action_last_page) {
        action_last_page = null;
    }
    if (!action_page_buttons) {
        action_page_buttons = null;
    }

    //最後一頁
    const last_page = data.last_page;
    //點選之頁數，預設為第一頁
    const current_page = data.current_page;

    //設定"上一頁"與"下一頁"之按鈕值
    if (action_current_page != null && action_last_page != null) {
        $('#' + action_current_page).val(current_page);
        $('#' + action_last_page).val(last_page);
    } else {
        $('#current_page').val(current_page);
        $('#last_page').val(last_page);
    }

    //預設第一顆按鈕數值為1
    let first_page_button = 1;
    //預設最多顯示五顆按鈕
    let total_page_buttons = 5;

    //若最後一頁小於第5頁
    if (last_page < 5) {
        total_page_buttons = last_page;
    }
    //讓已點選按鈕維持在五個按鈕中的最中間
    if (current_page > 3 && last_page > 5) {
        first_page_button = current_page - 2;
        total_page_buttons = current_page + 2;

        //若按鈕數大於目前總頁數，需調整數字
        if(total_page_buttons>last_page){
            total_page_buttons = last_page;
        }
    }

    //演算法用變數，用以維持設定最後5頁之對應按鈕顯示狀態(最後一頁大於第5頁時)
    let minus_page = 0;
    //設定最後5頁之對應按鈕顯示狀態
    if (current_page > 5 && last_page > 5) {
        if (current_page >= last_page - 2) {
            minus_page = 2;
            if (current_page === last_page) {
                minus_page = 4;
            }
            if (current_page === last_page - 1) {
                minus_page = 3;
            }
            first_page_button = current_page - minus_page;
            total_page_buttons = last_page;
        }
    }

    let html = '';
    //建立頁籤之按鈕
    for (let i = first_page_button; i <= total_page_buttons; i++) {
        if (action_page_buttons != null) {
            html += '<input type="button" class="btn_simple_page ui button white-solid-btn" style="margin-right: 2px;" id="action_page_button_' + i + '" onclick="clickChangePage(\'set\', this.value, ' + function_name + ', \'' + action_current_page + '\', \'' + action_last_page + '\')" value="' + i + '">';
        }else{
            html += '<input type="button" class="btn_simple_page ui button white-solid-btn" style="margin-right: 2px;" id="page_button_' + i + '" onclick="clickChangePage(\'set\', this.value, '+function_name+')" value="' + i + '">';
        }
    }

    if (action_page_buttons != null) {
        $('#' + action_page_buttons).html(html);
    } else {
        $('#page_buttons').html(html);
    }
}

/**
 * 點擊頁籤
 *
 * @param {string} type
 * @param {int} object_value
 * @param {string} callback - 用來刷新列表的函式
 * @param {string} action_current_page - 另指定頁次欄位
 * @param {string} action_last_page - 另指定頁次欄位
 */
function clickChangePage(type, object_value, callback, action_current_page, action_last_page) {
    if (!object_value) {
        object_value = null;
    }
    if (!action_current_page) {
        action_current_page = null;
    }
    if (!action_last_page) {
        action_last_page = null;
    }
    let selector_current_page = $('#current_page');
    if (action_current_page != null) {
        selector_current_page = $('#' + action_current_page);
    }

    let selector_last_page = $('#last_page').val();
    if (action_last_page != null) {
        selector_last_page = $('#' + action_last_page).val();
    }

    switch (type) {
        case 'previous':
            let min_page = parseInt(selector_current_page.val()) - 1;
            if (min_page < 1) {
                min_page = 1;
                // successMessage("已達第一頁");
                // return;
            }
            selector_current_page.val(min_page);
            break;
        case 'next':
            let max_page = parseInt(selector_current_page.val()) + 1;
            if (max_page > selector_last_page) {
                max_page = selector_last_page;
                // successMessage("已達最末頁");
                // return;
            }
            selector_current_page.val(max_page);
            break;
        case 'first':
            selector_current_page.val(1);
            break;
        case 'last':
            selector_current_page.val(selector_last_page);
            break;
        case 'set':
            selector_current_page.val(object_value);
            break;
    }

    //刷新頁面
    callback();
}

