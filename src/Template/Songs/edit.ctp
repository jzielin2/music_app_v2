<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $song->Id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $song->Id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Songs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="songs form large-9 medium-8 columns content">
    <?= $this->Form->create($song) ?>
    <fieldset>
        <legend><?= __('Edit Song') ?></legend>
        <?php
            echo $this->Form->input('User_Id');
            echo $this->Form->input('Album');
            echo $this->Form->input('Artist');
            echo $this->Form->input('BitRate');
            echo $this->Form->input('Composer');
            echo $this->Form->input('Genre');
            echo $this->Form->input('Kind');
            echo $this->Form->input('Name');
            echo $this->Form->input('PlayCount');
            echo $this->Form->input('PlayDateUTC', ['empty' => true]);
            echo $this->Form->input('Rating');
            echo $this->Form->input('SampleRate');
            echo $this->Form->input('Size');
            echo $this->Form->input('SkipCount');
            echo $this->Form->input('TotalTime');
            echo $this->Form->input('TrackID');
            echo $this->Form->input('Year');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
