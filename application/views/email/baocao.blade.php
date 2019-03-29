<html>
    <head>
        <style>
            .fr-view strong {
                font-weight: 700;
            }
            .fr-view table {
                border: none;
                border-collapse: collapse;
                empty-cells: show;
                max-width: 100%;
            }
            .fr-view table.fr-dashed-borders td,
            .fr-view table.fr-dashed-borders th {
                border-style: dashed;
            }
            .fr-view table.fr-alternate-rows tbody tr:nth-child(2n) {
                background: #f5f5f5;
            }
            .fr-view table td,
            .fr-view table th {
                border: 1px solid #dddddd;
            }
            .fr-view table td:empty,
            .fr-view table th:empty {
                height: 20px;
            }
            .fr-view table td.fr-highlighted,
            .fr-view table th.fr-highlighted {
                border: 1px double red;
            }
            .fr-view table td.fr-thick,
            .fr-view table th.fr-thick {
                border-width: 2px;
            }
            .fr-view table th {
                background: #e6e6e6;
            }
            .fr-view hr {
                clear: both;
                user-select: none;
                -o-user-select: none;
                -moz-user-select: none;
                -khtml-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
                page-break-after: always;
            }
            .fr-view .fr-file {
                position: relative;
            }
            .fr-view pre {
                white-space: pre-wrap;
                word-wrap: break-word;
            }
            .fr-view blockquote {
                border-left: solid 2px #5e35b1;
                margin-left: 0;
                padding-left: 5px;
                color: #5e35b1;
            }
            .fr-view blockquote blockquote {
                border-color: #00bcd4;
                color: #00bcd4;
            }
            .fr-view blockquote blockquote blockquote {
                border-color: #43a047;
                color: #43a047;
            }
            .fr-view span.fr-emoticon.fr-emoticon-img {
                background-repeat: no-repeat !important;
                font-size: inherit;
                height: 1em;
                width: 1em;
                min-height: 20px;
                min-width: 20px;
                display: inline-block;
                margin: -0.1em 0.1em 0.1em;
                line-height: 1;
                vertical-align: middle;
            }
            .fr-view .fr-text-gray {
                color: #AAA !important;
            }
            .fr-view .fr-text-bordered {
                border-top: solid 1px #222;
                border-bottom: solid 1px #222;
                padding: 10px 0;
            }
            .fr-view .fr-text-spaced {
                letter-spacing: 1px;
            }
            .fr-view .fr-text-uppercase {
                text-transform: uppercase;
            }
            .fr-view img {
                position: relative;
                max-width: 100%;
            }
            .fr-view img.fr-dib {
                margin: 5px auto;
                display: block;
                float: none;
                vertical-align: top;
            }
            .fr-view img.fr-dib.fr-fil {
                margin-left: 0;
            }
            .fr-view img.fr-dib.fr-fir {
                margin-right: 0;
            }
            .fr-view img.fr-dii {
                display: inline-block;
                float: none;
                vertical-align: bottom;
                margin-left: 5px;
                margin-right: 5px;
                max-width: calc(100% - (2 * 5px));
            }
            .fr-view img.fr-dii.fr-fil {
                float: left;
                margin: 5px 5px 5px 0;
                max-width: calc(100% - 5px);
            }
            .fr-view img.fr-dii.fr-fir {
                float: right;
                margin: 5px 0 5px 5px;
                max-width: calc(100% - 5px);
            }
            .fr-view img.fr-rounded {
                border-radius: 100%;
                -moz-border-radius: 100%;
                -webkit-border-radius: 100%;
                -moz-background-clip: padding;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;
            }
            .fr-view img.fr-bordered {
                border: solid 10px #CCC;
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
            }
            .fr-view .fr-video {
                text-align: center;
                position: relative;
            }
            .fr-view .fr-video > * {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                max-width: 100%;
                border: none;
            }
            .fr-view .fr-video.fr-dvb {
                display: block;
                clear: both;
            }
            .fr-view .fr-video.fr-dvb.fr-fvl {
                text-align: left;
            }
            .fr-view .fr-video.fr-dvb.fr-fvr {
                text-align: right;
            }
            .fr-view .fr-video.fr-dvi {
                display: inline-block;
            }
            .fr-view .fr-video.fr-dvi.fr-fvl {
                float: left;
            }
            .fr-view .fr-video.fr-dvi.fr-fvr {
                float: right;
            }
            .fr-view a.fr-strong {
                font-weight: 700;
            }
            .fr-view a.fr-green {
                color: green;
            }
            .fr-view button.fr-rounded,
            .fr-view input.fr-rounded,
            .fr-view textarea.fr-rounded {
                border-radius: 10px;
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                -moz-background-clip: padding;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;
            }
            .fr-view button.fr-large,
            .fr-view input.fr-large,
            .fr-view textarea.fr-large {
                font-size: 24px;
            }
            /**
             * Image style.
             */
            a.fr-view.fr-strong {
                font-weight: 700;
            }
            a.fr-view.fr-green {
                color: green;
            }
            /**
             * Link style.
             */
            img.fr-view {
                position: relative;
                max-width: 100%;
            }
            img.fr-view.fr-dib {
                margin: 5px auto;
                display: block;
                float: none;
                vertical-align: top;
            }
            img.fr-view.fr-dib.fr-fil {
                margin-left: 0;
            }
            img.fr-view.fr-dib.fr-fir {
                margin-right: 0;
            }
            img.fr-view.fr-dii {
                display: inline-block;
                float: none;
                vertical-align: bottom;
                margin-left: 5px;
                margin-right: 5px;
                max-width: calc(100% - (2 * 5px));
            }
            img.fr-view.fr-dii.fr-fil {
                float: left;
                margin: 5px 5px 5px 0;
                max-width: calc(100% - 5px);
            }
            img.fr-view.fr-dii.fr-fir {
                float: right;
                margin: 5px 0 5px 5px;
                max-width: calc(100% - 5px);
            }
            img.fr-view.fr-rounded {
                border-radius: 100%;
                -moz-border-radius: 100%;
                -webkit-border-radius: 100%;
                -moz-background-clip: padding;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;
            }
            img.fr-view.fr-bordered {
                border: solid 10px #CCC;
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
            }
        </style>
    </head>
    <body>
        <p><strong>1.Nhà cung cấp: </strong></p><div class='fr-view' style="white-space: pre"><?= $ncc ?></div>
        <p><strong>2.Nhân sự tham gia: </strong></p><div class='fr-view' style="white-space: pre"><?= $nhansu ?></div>
        <p><strong>3.Nhân sự khác: </strong></p><div class='fr-view' style="white-space: pre"><?= $nhansukhac ?></div>
        <p><strong>4.Khách hàng chính: </strong></p><div><?= $listcustomer ?></div><div class='fr-view' style="white-space: pre"><?= $new_customer ?></div>
        <p><strong>5.Sản phẩm chính: </strong></p><div><?= $listproduct ?></div><div class='fr-view' style="white-space: pre"><?= $new_product ?></div>
        <p><strong>6.Thời gian cuộc họp: </strong><?= $date ?></p>
        <p><strong>7.Chia sẻ thông tin: </strong><?= $email_send ?></p>
        <p><strong>8.Nội dung: </strong></p><div class='fr-view' style="white-space: pre"><?= $content ?></div>
        <p><strong>9.Lưu ý đặc biệt: </strong></p><div class='fr-view' style="white-space: pre"><?= $note ?></div>
    </body>
</html>