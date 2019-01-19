<?php
 namespace Doctrine\DBAL\Schema; class ColumnDiff { public $oldColumnName; public $column; public $changedProperties = array(); public $fromColumn; public function __construct($oldColumnName, Column $column, array $changedProperties = array(), Column $fromColumn = null) { $this->oldColumnName = $oldColumnName; $this->column = $column; $this->changedProperties = $changedProperties; $this->fromColumn = $fromColumn; } public function hasChanged($propertyName) { return in_array($propertyName, $this->changedProperties); } public function getOldColumnName() { $quote = $this->fromColumn && $this->fromColumn->isQuoted(); return new Identifier($this->oldColumnName, $quote); } } 