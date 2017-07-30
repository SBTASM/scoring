<script type="text/javascript">
    function scoringProjectKey(){
        return "<?= $project->key ?>";
    }
        function route(){
        return "<?= \yii\helpers\Url::to(['scoring/index'], true) ?>";
    }
</script>
<script src="<?= \yii\helpers\Url::to('@web/js/scoring.js', true) ?>"></script>