<?php
$fi = new FilesystemIterator("acc/data", FilesystemIterator::SKIP_DOTS);
echo iterator_count($fi) - 1;