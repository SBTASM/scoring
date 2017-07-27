<script src="<?= \yii\helpers\Url::to('@web/js/scoring.js', true) ?>"></script>
<script type="text/javascript">
    function scoringProjectKey(){
        return "<?= $project->key ?>";
    }
    function route(){
        return "<?= \yii\helpers\Url::to(['scoring/index'], true) ?>";
    }
</script>
<body>
<form>
    Email:<input type="text" id="scoring_visitor_email" name="email">
    <button type="button" onclick="scoring_with_email()">Зарегистрироватся</button>
</form>