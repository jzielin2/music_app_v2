<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Song'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="songs index large-9 medium-8 columns content">
    <h3><?= __('Songs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Id') ?></th>
                <th><?= $this->Paginator->sort('User_Id') ?></th>
                <th><?= $this->Paginator->sort('Album') ?></th>
                <th><?= $this->Paginator->sort('Artist') ?></th>
                <th><?= $this->Paginator->sort('BitRate') ?></th>
                <th><?= $this->Paginator->sort('Composer') ?></th>
                <th><?= $this->Paginator->sort('Genre') ?></th>
                <th><?= $this->Paginator->sort('Kind') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('PlayCount') ?></th>
                <th><?= $this->Paginator->sort('PlayDateUTC') ?></th>
                <th><?= $this->Paginator->sort('Rating') ?></th>
                <th><?= $this->Paginator->sort('SampleRate') ?></th>
                <th><?= $this->Paginator->sort('Size') ?></th>
                <th><?= $this->Paginator->sort('SkipCount') ?></th>
                <th><?= $this->Paginator->sort('TotalTime') ?></th>
                <th><?= $this->Paginator->sort('TrackID') ?></th>
                <th><?= $this->Paginator->sort('Year') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($songs as $song): ?>
            <tr>
                <td><?= $this->Number->format($song->Id) ?></td>
                <td><?= $this->Number->format($song->User_Id) ?></td>
                <td><?= h($song->Album) ?></td>
                <td><?= h($song->Artist) ?></td>
                <td><?= h($song->BitRate) ?></td>
                <td><?= h($song->Composer) ?></td>
                <td><?= h($song->Genre) ?></td>
                <td><?= h($song->Kind) ?></td>
                <td><?= h($song->Name) ?></td>
                <td><?= $this->Number->format($song->PlayCount) ?></td>
                <td><?= h($song->PlayDateUTC) ?></td>
                <td><?= $this->Number->format($song->Rating) ?></td>
                <td><?= h($song->SampleRate) ?></td>
                <td><?= $this->Number->format($song->Size) ?></td>
                <td><?= $this->Number->format($song->SkipCount) ?></td>
                <td><?= h($song->TotalTime) ?></td>
                <td><?= h($song->TrackID) ?></td>
                <td><?= $this->Number->format($song->Year) ?></td>
                <td><?= h($song->created) ?></td>
                <td><?= h($song->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $song->Id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $song->Id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $song->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $song->Id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
