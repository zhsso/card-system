<?php
 namespace Doctrine\DBAL\Schema\Visitor; use Doctrine\DBAL\Platforms\AbstractPlatform; use Doctrine\DBAL\Schema\Table; use Doctrine\DBAL\Schema\ForeignKeyConstraint; use Doctrine\DBAL\Schema\Sequence; class CreateSchemaSqlCollector extends AbstractVisitor { private $createNamespaceQueries = array(); private $createTableQueries = array(); private $createSequenceQueries = array(); private $createFkConstraintQueries = array(); private $platform = null; public function __construct(AbstractPlatform $platform) { $this->platform = $platform; } public function acceptNamespace($namespaceName) { if ($this->platform->supportsSchemas()) { $this->createNamespaceQueries = array_merge( $this->createNamespaceQueries, (array) $this->platform->getCreateSchemaSQL($namespaceName) ); } } public function acceptTable(Table $table) { $this->createTableQueries = array_merge($this->createTableQueries, (array) $this->platform->getCreateTableSQL($table)); } public function acceptForeignKey(Table $localTable, ForeignKeyConstraint $fkConstraint) { if ($this->platform->supportsForeignKeyConstraints()) { $this->createFkConstraintQueries = array_merge( $this->createFkConstraintQueries, (array) $this->platform->getCreateForeignKeySQL( $fkConstraint, $localTable ) ); } } public function acceptSequence(Sequence $sequence) { $this->createSequenceQueries = array_merge( $this->createSequenceQueries, (array) $this->platform->getCreateSequenceSQL($sequence) ); } public function resetQueries() { $this->createNamespaceQueries = array(); $this->createTableQueries = array(); $this->createSequenceQueries = array(); $this->createFkConstraintQueries = array(); } public function getQueries() { $sql = array(); foreach ($this->createNamespaceQueries as $schemaSql) { $sql = array_merge($sql, (array) $schemaSql); } foreach ($this->createTableQueries as $schemaSql) { $sql = array_merge($sql, (array) $schemaSql); } foreach ($this->createSequenceQueries as $schemaSql) { $sql = array_merge($sql, (array) $schemaSql); } foreach ($this->createFkConstraintQueries as $schemaSql) { $sql = array_merge($sql, (array) $schemaSql); } return $sql; } } 