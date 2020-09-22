<?php
use richardfan\widget\JSRegister;



JSRegister::begin(); ?>
<script>

    console.log('hi');

    //$.ajax({
    //    url: '<?php //echo Yii::$app->request->baseUrl. '/supermarkets/sample' ?>//',
    //    type: 'post',
    //    data: {
    //        searchname: $("#searchname").val() ,
    //        searchby:$("#searchby").val() ,
    //        _csrf : '<?//=Yii::$app->request->getCsrfToken()?>//'
    //    },
    //    success: function (data) {
    //        console.log(data.search);
    //    }
    //});



</script>
<?php JSRegister::end(); ?>