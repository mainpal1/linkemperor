 <div class="pagination pagination-large">
    <ul class="pagination">
            <?php
				echo $this->Paginator->first('<<', array('tag' => 'li', 'title' => __('First'), 'escape' => false));
                echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'prev disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => ''));
                echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'next disabled','disabledTag' => 'a'));
				echo $this->Paginator->last('>>', array('tag' => 'li', 'title' => __('last'), 'escape' => false));
            ?>
    <ul>
 </div>