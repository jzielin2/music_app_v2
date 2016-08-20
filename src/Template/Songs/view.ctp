<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Song'), ['action' => 'edit', $song->Id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Song'), ['action' => 'delete', $song->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $song->Id)]) ?> </li>
        <li><?= $this->Html->link(__('List Songs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Song'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="songs view large-9 medium-8 columns content">
    <h3><?= h($song->Id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Album') ?></th>
            <td><?= h($song->Album) ?></td>
        </tr>
        <tr>
            <th><?= __('Artist') ?></th>
            <td><?= h($song->Artist) ?></td>
        </tr>
        <tr>
            <th><?= __('BitRate') ?></th>
            <td><?= h($song->BitRate) ?></td>
        </tr>
        <tr>
            <th><?= __('Composer') ?></th>
            <td><?= h($song->Composer) ?></td>
        </tr>
        <tr>
            <th><?= __('Genre') ?></th>
            <td><?= h($song->Genre) ?></td>
        </tr>
        <tr>
            <th><?= __('Kind') ?></th>
            <td><?= h($song->Kind) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($song->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('SampleRate') ?></th>
            <td><?= h($song->SampleRate) ?></td>
        </tr>
        <tr>
            <th><?= __('TotalTime') ?></th>
            <td><?= h($song->TotalTime) ?></td>
        </tr>
        <tr>
            <th><?= __('TrackID') ?></th>
            <td><?= h($song->TrackID) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($song->Id) ?></td>
        </tr>
        <tr>
            <th><?= __('User Id') ?></th>
            <td><?= $this->Number->format($song->User_Id) ?></td>
        </tr>
        <tr>
            <th><?= __('PlayCount') ?></th>
            <td><?= $this->Number->format($song->PlayCount) ?></td>
        </tr>
        <tr>
            <th><?= __('Rating') ?></th>
            <td><?= $this->Number->format($song->Rating) ?></td>
        </tr>
        <tr>
            <th><?= __('Size') ?></th>
            <td><?= $this->Number->format($song->Size) ?></td>
        </tr>
        <tr>
            <th><?= __('SkipCount') ?></th>
            <td><?= $this->Number->format($song->SkipCount) ?></td>
        </tr>
        <tr>
            <th><?= __('Year') ?></th>
            <td><?= $this->Number->format($song->Year) ?></td>
        </tr>
        <tr>
            <th><?= __('PlayDateUTC') ?></th>
            <td><?= h($song->PlayDateUTC) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($song->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($song->modified) ?></td>
        </tr>
    </table>
</div>
