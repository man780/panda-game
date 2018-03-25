<?
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$script = <<< JS
    $('.achievement-item').click(function(){
        $(this).toggleClass('gray');
        $(this).toggleClass('active');
        var myAchievements = $('input.myAchievements').val();
        var achievement_id = $(this).attr('data-achievement-id');
        if(myAchievements == ''){
            myAchievements = achievement_id;
        }else{
            var myAchievementsArr = myAchievements.split(',');
            if(jQuery.inArray(achievement_id, myAchievementsArr)=== -1 ){
                myAchievementsArr.push(achievement_id);
                myAchievementsArr.sort();
                myAchievements = myAchievementsArr.join(',');
            }else{
                myAchievementsArr = jQuery.grep(myAchievementsArr, function(value) {
                  return value != achievement_id;
                });
                myAchievementsArr.sort();
                myAchievements = myAchievementsArr.join(',');
            }
        }
        $('input.myAchievements').val(myAchievements);
    });
JS;
$this->registerJs($script);
?>
<style>
    .achievement-item{
        float: left;
        width: 100px;
        cursor: pointer;
        font-weight: bold;
    }
    .gray{
        -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
        filter: grayscale(100%);
        font-weight: normal;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-1"><?=Html::img('/'.$model->avatar, ['style' => ['width' => '100%']]);?></div>
        <div class="col-md-4"><b><?=$model->fname?> <?=$model->name?></b></div>
        <div class="col-md-4"><b><?=$rate?></b> <img src="/images/panda.jpg" height="20px"/></div>
    </div>
    <div class="row">
        <h2><?=Yii::t('app', 'Achievements');?></h2>
        <p>
            Кликните на достижения для присвоения!
        </p>
        <?foreach($achievements as $achievement):?>
            <?//vd([$achievement->id, $myAchievementsIds]);?>
            <?$class = (in_array($achievement->id, explode(',', $myAchievementsIds)))?'active':'gray';?>
        <div class="achievement-item <?=$class?>" data-achievement-id="<?=$achievement->id?>">
            <?=Html::img('/'.$achievement->image, ['style' => ['height' => '50px']])?>
            <p>
                <?=$achievement->name?>
            </p>
        </div>
        <?endforeach;?>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <?=Html::hiddenInput('achievements', $myAchievementsIds, ['class' => 'myAchievements']); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>
