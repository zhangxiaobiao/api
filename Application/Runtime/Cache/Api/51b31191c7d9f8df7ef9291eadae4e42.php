<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="/api/Application/Public/Api/js/jquery.js"></script>
    <script>
        $(function(){
            $('#phone').on('blur', function(){
                $.ajax({
                    type: "GET",
                    url: "<?php echo U('Index/phoneAddr');?>",
                    data: {num:$(this).val()},
                    dataType: "json",
                    success: function(dat){
                        $('#addr').html(dat);
                    }
                });
            });
        });
    </script>
</head>
<body>
    电话：<input type="text" id="phone">
    <br>
<span id="addr"></span>
</body>
</html>