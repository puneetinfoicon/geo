<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.4.7/standard-all/ckeditor.js"></script>
<script src="http://cdn.ckeditor.com/4.4.7/standard-all/adapters/jquery.js"></script>

<div  class="ckeditor">
        <textarea id="ck_texteditor">{{ $content }}</textarea>
</div>

<script>
    $(document).ready(function(){
    var config = {
        height : 280,
        width : 1000,
        fullPage : true,
        linkShowAdvancedTab : false,
        scayt_autoStartup : true,
        enterMode : Number(2),
        toolbar : [
            ['Styles','Bold', 'Italic', 'Underline', '-',
             'NumberedList','BulletedList', 'SpellChecker', '-', 'Undo',
             'Redo', '-', 'SelectAll', 'NumberedList',
             'BulletedList','FontSize','Table' ], [ 'UIColor' ] ]
    };

    $("#ck_texteditor").ckeditor(config);
});
</script>
