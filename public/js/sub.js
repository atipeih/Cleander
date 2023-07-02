{

  $(".menu_button").click(function () {
    $(".g-nav").toggleClass('panelactive');
  });


  $(".g-nav button").click(function() {
    $(".g-nav").removeClass('panelactive');
  });

  $('.like').on('click', function ()
    {
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        postid = $(this).attr("postid");
        likeflg = $(this).attr("likeflg");
        click_button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  //基本的にはデフォルトでOK
            },
            url: '/like',  //route.phpで指定したコントローラーのメソッドURLを指定
            type: 'POST',   //GETかPOSTメソットを選択
            data: { 'postid': postid, 'likeflg': likeflg, }, //コントローラーに送るに名称をつけてデータを指定
                })
            //正常にコントローラーの処理が完了した場合
            .done(function (data) //コントローラーからのリターンされた値をdataとして指定
            {
                if ( data == 0 )
                {
                    //クリックしたタグのステータスを変更
                    click_button.attr("likeflg", "1");
                    click_button.attr("class", "btn btn-primary like");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.children().attr("class", "bi  bi-check-lg");
                }
                if ( data == 1 )
                {
                    //クリックしたタグのステータスを変更
                    click_button.attr("likeflg", "0");
                    click_button.attr("class", "btn btn-outline-primary like");
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.children().attr("class", "bi  bi-hand-thumbs-up");
                }
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert('いいね処理失敗');
                alert(JSON.stringify(data));
            });
    });
  $('.postDelete').on('click', function ()
    {
        if(! confirm("本当に削除しますか？")){
            return false;
        }
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        postid = $(this).attr("postid");
        username = $(this).attr("name");
        click_button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  //基本的にはデフォルトでOK
            },
            url: '/postDelete',  //route.phpで指定したコントローラーのメソッドURLを指定
            type: 'POST',   //GETかPOSTメソットを選択
            data: { 'postid': postid, 'name': username, }, //コントローラーに送るに名称をつけてデータを指定
                })
            //正常にコントローラーの処理が完了した場合
            .done(function (data) //コントローラーからのリターンされた値をdataとして指定
            {
                if ( data == 0 )
                {
                    //クリックしたタグの子の要素を変更(表示されているハートの模様を書き換える)
                    click_button.parents('.card').attr("class", "d-none");
                }else{
                    alert('不正な操作が行われました');
                }
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert('削除処理失敗');
                alert(JSON.stringify(data));
            });
    });

    $('.userDelete').on('click', function ()
    {
        if(! confirm("本当に削除しますか？")){
            return false;
        }
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        id = $(this).attr("id");
        targetid = $(this).attr('targetid');
        click_button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/userDelete',
            type: 'POST',
            data: { 'targetid': targetid, }, //コントローラーに送るデータを指定
                })
            //正常にコントローラーの処理が完了した場合
            .done(function (data)
            {
                click_button.parent().attr("class", "d-none");
                alert('ユーザーID'+data+'を削除しました');
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert('削除処理失敗');
                alert(JSON.stringify(data));
            });
    });

}
