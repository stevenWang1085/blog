---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_f7b7ea397f8939c8bb93e6cab64603ce -->
## Display Swagger API page.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/documentation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/documentation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/documentation`


<!-- END_f7b7ea397f8939c8bb93e6cab64603ce -->

<!-- START_1ead214f30a5e235e7140eb2aaa29eee -->
## Dump api-docs.json content endpoint.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/docs/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/docs/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "openapi": "3.0.0",
    "info": {
        "title": "Forum API",
        "version": "0.1"
    },
    "paths": {
        "\/api\/article": {
            "get": {
                "tags": [
                    "Article"
                ],
                "summary": "取得文章列表",
                "description": "取得文章列表",
                "operationId": "f4c6a1c1e2e3a6d071675da1a11de268",
                "parameters": [
                    {
                        "name": "order_column",
                        "in": "query",
                        "description": "排序欄位(created_at、favor、comments)",
                        "required": true,
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "name": "order_column_by",
                        "in": "query",
                        "description": "排序形式(asc、desc)",
                        "required": true,
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "name": "board_id",
                        "in": "query",
                        "description": "看板代號",
                        "required": false,
                        "schema": {
                            "type": "integer"
                        }
                    },
                    {
                        "name": "title",
                        "in": "query",
                        "description": "標題",
                        "required": false,
                        "schema": {
                            "type": "string"
                        }
                    },
                    {
                        "name": "contents",
                        "in": "query",
                        "description": "內容",
                        "required": false,
                        "schema": {
                            "type": "string"
                        }
                    }
                ],
                "responses": {
                    "1201": {
                        "description": "查詢成功"
                    },
                    "1202": {
                        "description": "查無資料"
                    },
                    "400": {
                        "description": "程式異常"
                    }
                }
            }
        }
    }
}
```

### HTTP Request
`GET docs/{jsonFile?}`

`POST docs/{jsonFile?}`

`PUT docs/{jsonFile?}`

`PATCH docs/{jsonFile?}`

`DELETE docs/{jsonFile?}`

`OPTIONS docs/{jsonFile?}`


<!-- END_1ead214f30a5e235e7140eb2aaa29eee -->

<!-- START_1a23c1337818a4de9e417863aebaca33 -->
## docs/asset/{asset}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/docs/asset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/docs/asset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "(1) - this L5 Swagger asset is not allowed"
}
```

### HTTP Request
`GET docs/asset/{asset}`


<!-- END_1a23c1337818a4de9e417863aebaca33 -->

<!-- START_a2c4ea37605c6d2e3c93b7269030af0a -->
## Display Oauth2 callback pages.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/oauth2-callback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/oauth2-callback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/oauth2-callback`


<!-- END_a2c4ea37605c6d2e3c93b7269030af0a -->

<!-- START_2b6e5a4b188cb183c7e59558cce36cb6 -->
## api/user
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 400,
    "status_message": "此方法不允許",
    "return_data": null,
    "code": "1501"
}
```

### HTTP Request
`GET api/user`


<!-- END_2b6e5a4b188cb183c7e59558cce36cb6 -->

<!-- START_f0654d3f2fc63c11f5723f233cc53c83 -->
## api/user
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user`


<!-- END_f0654d3f2fc63c11f5723f233cc53c83 -->

<!-- START_ceec0e0b1d13d731ad96603d26bccc2f -->
## api/user/{user}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 400,
    "status_message": "No query results for model [App\\Management\\User\\Entity].",
    "return_data": null,
    "code": "11"
}
```

### HTTP Request
`GET api/user/{user}`


<!-- END_ceec0e0b1d13d731ad96603d26bccc2f -->

<!-- START_a4a2abed1e8e8cad5e6a3282812fe3f3 -->
## api/user/{user}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/user/{user}`

`PATCH api/user/{user}`


<!-- END_a4a2abed1e8e8cad5e6a3282812fe3f3 -->

<!-- START_4bb7fb4a7501d3cb1ed21acfc3b205a9 -->
## api/user/{user}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/user/{user}`


<!-- END_4bb7fb4a7501d3cb1ed21acfc3b205a9 -->

<!-- START_57e3b4272508c324659e49ba5758c70f -->
## api/user/login
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/login`


<!-- END_57e3b4272508c324659e49ba5758c70f -->

<!-- START_7da65cba6a9d1abed7b285ed201c4883 -->
## api/user/forget_password/send
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/forget_password/send" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/forget_password/send"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/forget_password/send`


<!-- END_7da65cba6a9d1abed7b285ed201c4883 -->

<!-- START_b9fb39604d762854a947bf0bb352c469 -->
## api/user/reset_code/check
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/reset_code/check" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/reset_code/check"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/reset_code/check`


<!-- END_b9fb39604d762854a947bf0bb352c469 -->

<!-- START_d170ac8dc271cec6985501e9307a6b3a -->
## api/user/reset_code_page/check
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user/reset_code_page/check" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/reset_code_page/check"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (402):

```json
{
    "http_status_code": 402,
    "status_message": "格式驗證錯誤，如下：信箱為必填。",
    "return_data": null,
    "code": "1601"
}
```

### HTTP Request
`GET api/user/reset_code_page/check`


<!-- END_d170ac8dc271cec6985501e9307a6b3a -->

<!-- START_da119a34bddc629d20b986d76e96b479 -->
## api/user/forget_password/check
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/forget_password/check" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/forget_password/check"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/forget_password/check`


<!-- END_da119a34bddc629d20b986d76e96b479 -->

<!-- START_ce7af384a8eb198ec28d752586f4ff17 -->
## api/user/logout
> Example request:

```bash
curl -X POST \
    "http://localhost/api/user/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/logout`


<!-- END_ce7af384a8eb198ec28d752586f4ff17 -->

<!-- START_8ad254284e7edaa645573384de2b45a4 -->
## /get-trd (這裡先寫 API 的 URI)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
端點說明

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/board?page=4+%28%E6%9F%A5%E8%A9%A2%E5%AD%97%E4%B8%B2%E5%8F%83%E6%95%B8%E5%B8%B6%E7%AF%84%E4%BE%8B%EF%BC%8C%E4%BE%9D%E5%BA%8F%E7%82%BA%E5%90%8D%E7%A8%B1+%E5%BF%85%E5%A1%AB+%E8%AA%AA%E6%98%8E+%E7%AF%84%E4%BE%8B%29" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"excepturi","dorder_ser":"ex","hcust_id":"beatae"}'

```

```javascript
const url = new URL(
    "http://localhost/api/board"
);

let params = {
    "page": "4 (查詢字串參數帶範例，依序為名稱 必填 說明 範例)",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "excepturi",
    "dorder_ser": "ex",
    "hcust_id": "beatae"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```
> Example response (404):

```json
null
```

### HTTP Request
`GET api/board`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `lang` |  optional  | The language (路徑參數，依序為名稱 說明)
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | The page number.
    `user_id` |  required  | The id of the user.查詢字串參數不要帶範例)
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | 類型 (表單參數，依序為名稱 型別 必填 說明)
        `dorder_ser` | required |  optional  | 
        `hcust_id` | required |  optional  | 會員主鍵
    
<!-- END_8ad254284e7edaa645573384de2b45a4 -->

<!-- START_27fe92db4d5f4b8bdc3dd7f3553d23a6 -->
## api/board
> Example request:

```bash
curl -X POST \
    "http://localhost/api/board" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/board"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/board`


<!-- END_27fe92db4d5f4b8bdc3dd7f3553d23a6 -->

<!-- START_43d1e4e4d97a665b4e46839791ed5286 -->
## api/board/{board}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/board/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/board/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 403,
    "status_message": "尚未登入",
    "return_data": null,
    "code": "1503"
}
```

### HTTP Request
`GET api/board/{board}`


<!-- END_43d1e4e4d97a665b4e46839791ed5286 -->

<!-- START_c39c7d57801c65783efc2ac8a6b4384e -->
## api/board/{board}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/board/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/board/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/board/{board}`

`PATCH api/board/{board}`


<!-- END_c39c7d57801c65783efc2ac8a6b4384e -->

<!-- START_8a47d949e9cd3fabf69fe6195ae30fe9 -->
## api/board/{board}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/board/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/board/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/board/{board}`


<!-- END_8a47d949e9cd3fabf69fe6195ae30fe9 -->

<!-- START_280a28fc53a425f7521a44fe924a3ea6 -->
## api/article
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/article" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 403,
    "status_message": "尚未登入",
    "return_data": null,
    "code": "1503"
}
```

### HTTP Request
`GET api/article`


<!-- END_280a28fc53a425f7521a44fe924a3ea6 -->

<!-- START_706a660bd426dfde8ef5e730869db3f8 -->
## api/article
> Example request:

```bash
curl -X POST \
    "http://localhost/api/article" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/article`


<!-- END_706a660bd426dfde8ef5e730869db3f8 -->

<!-- START_c709936176b012d978b4cd88be5c715b -->
## api/article/{article}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/article/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 403,
    "status_message": "尚未登入",
    "return_data": null,
    "code": "1503"
}
```

### HTTP Request
`GET api/article/{article}`


<!-- END_c709936176b012d978b4cd88be5c715b -->

<!-- START_ce91a33a4d42d13bc552516d0fc4ffd5 -->
## api/article/{article}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/article/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/article/{article}`

`PATCH api/article/{article}`


<!-- END_ce91a33a4d42d13bc552516d0fc4ffd5 -->

<!-- START_405fe78cb0f9d9ab5e425bf9c56e0ca1 -->
## api/article/{article}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/article/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/article/{article}`


<!-- END_405fe78cb0f9d9ab5e425bf9c56e0ca1 -->

<!-- START_37ad2241b1cdea7506d5721c7d2dbc6b -->
## api/article/{id}/favor
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/article/1/favor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1/favor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/article/{id}/favor`


<!-- END_37ad2241b1cdea7506d5721c7d2dbc6b -->

<!-- START_9617531121e53a0edcda7133675118e9 -->
## api/article/{article_id}/comment
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/article/1/comment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1/comment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 403,
    "status_message": "尚未登入",
    "return_data": null,
    "code": "1503"
}
```

### HTTP Request
`GET api/article/{article_id}/comment`


<!-- END_9617531121e53a0edcda7133675118e9 -->

<!-- START_ae86dedabb1617196c37e5011f18f6b9 -->
## api/article/{article_id}/comment
> Example request:

```bash
curl -X POST \
    "http://localhost/api/article/1/comment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1/comment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/article/{article_id}/comment`


<!-- END_ae86dedabb1617196c37e5011f18f6b9 -->

<!-- START_f3d25082addc0d01b9415a3b692ae4a8 -->
## api/article/{comment_id}/comment
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/article/1/comment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1/comment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/article/{comment_id}/comment`


<!-- END_f3d25082addc0d01b9415a3b692ae4a8 -->

<!-- START_eb5008b62395f4f24d3e1dedfc985c4a -->
## api/article/{comment_id}/comment
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/article/1/comment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/article/1/comment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/article/{comment_id}/comment`


<!-- END_eb5008b62395f4f24d3e1dedfc985c4a -->

<!-- START_1951bf6e8c25004c2f29f27e94822aa1 -->
## api/comment/{comment_id}/reply
> Example request:

```bash
curl -X POST \
    "http://localhost/api/comment/1/reply" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/comment/1/reply"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/comment/{comment_id}/reply`


<!-- END_1951bf6e8c25004c2f29f27e94822aa1 -->

<!-- START_4fb25366280aa776535df05d0448a156 -->
## api/notification
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "http_status_code": 403,
    "status_message": "尚未登入",
    "return_data": null,
    "code": "1503"
}
```

### HTTP Request
`GET api/notification`


<!-- END_4fb25366280aa776535df05d0448a156 -->


