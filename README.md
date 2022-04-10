# 題目

實作通知推播系統

使用者的通知管道有
- email
- sms
- telegram

使用者的語系有
- zh-TW
- en

PD 會希望在特定的時間通知使用者，例如
- 註冊成功: email & sms
- 學生預約課程: email & telegram
- 學生取消課程: email & telegram

# 需求

請以程式碼的描述性以及擴充性為主設計該通知推播系統

寄送實體不用實作，直接將結果以字串印出來即可

# 範例啟動 及 測試方式

```
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
```

預約會產生測試資料，取消預約不會真的刪除資料

直接以 curl 測試
```
# 模擬事件觸發
curl --location --request POST 'http://localhost/api/appointment'
curl --location --request DELETE 'http://localhost/api/appointment/1'
```

# 說明

各事件實作在 `app/Events`

將事件依賴的 model 注入事件類別，透過組合來完成事件類別內的方法

事件繼承抽象類別 Event，用 namespace 來取得對應發送內容的翻譯檔路徑，語系設定與發送內容由子類別實作

各通知管道實作在 `app/Listeners/Cahnnels`

若需要調整或新增事件，只需要調整 `app/Events/*`，並繼承抽象類別 Event

如果要調整或新增通知管道，只需要調整 `app/Listeners/Cahnnels/*`，並注入抽象類別 Event ，透過事件父類別的介面去取得發送所需的事件資料

若要調整事件與通知管道的綁定，在 `EventServiceProvider.php` 內設定即可

# 其它說明

- 翻譯檔位於 `lang/*`
- 日常的情境為 request 進入到 controller ，跑完 business layer 即可觸發事件。參考 `app/Http/Controllers/AppointmentController.php`
