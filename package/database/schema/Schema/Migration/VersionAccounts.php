<?php

namespace Schema\Migration;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class VersionAccounts extends AbstractMigration{

	/**
	* @param Schema $schema
	*/
	public function up(Schema $schema):void{

		if($schema->hasTable("coa"))
            $schema->dropTable("coa");

        $coa = $schema->createTable('coa');
        $coa->addColumn('id', 'integer', array('autoincrement' => true));
        $coa->addColumn('alias', 'string');
        $coa->addColumn('code', 'string');
        $coa->addColumn('name', 'string');
        $coa->addColumn('descr', 'text');
        $coa->setPrimaryKey(array('id'));
        $coa->addUniqueIndex(array('alias'));

        if($schema->hasTable("journal"))
            $schema->dropTable("journal");

        $journal = $schema->createTable('journal');
        $journal->addColumn('id', 'integer', array('autoincrement' => true));
        $journal->addColumn('name', 'string', array('notNull'=>true));
        $journal->addColumn('descr', 'text');
        $journal->setPrimaryKey(array('id'));

        if($schema->hasTable("entry"))
            $schema->dropTable("entry");

        $entry = $schema->createTable('entry');
        $entry->addColumn('id', 'integer', array('autoincrement' => true));
        $entry->addColumn('credit', 'integer');
        $entry->addColumn('debit', 'integer');
        $entry->addColumn('note', 'string');
        $entry->addColumn('status', 'string');
        $entry->addColumn('created_at', 'datetime');
        $entry->setPrimaryKey(array('id'));

        $entry->addForeignKeyConstraint($coa, array("debit"), array("id"), array(

            "onUpdate" => "CASCADE"
        ));

        $entry->addForeignKeyConstraint($coa, array("credit"), array("id"), array(

            "onUpdate" => "CASCADE"
        ));

        $entry->addUniqueIndex(array('credit','debit'));


        if($schema->hasTable("entry_type"))
            $schema->dropTable("entry_type");
        
        $entryType = $schema->createTable('entry_type');
        $entryType->addColumn('id', 'integer', array('autoincrement' => true));
        $entryType->addColumn('name', 'string');
        $entryType->setPrimaryKey(array('id'));

        if($schema->hasTable("trx"))
            $schema->dropTable("trx");

        $trx = $schema->createTable('trx');
        $trx->addColumn('id', 'integer', array('autoincrement' => true));
        $trx->addColumn('entry_id', 'integer');
        $trx->addColumn('entry_type_id', 'integer');
        $trx->addColumn('journal_id', 'integer');
        $trx->addColumn("amount", "decimal", array('scale' => 2));
        $trx->addColumn('descr', 'string');
        $trx->addColumn('created_at', 'datetime');
        $trx->addUniqueIndex(array('descr'));
        $trx->setPrimaryKey(array('id'));

        $trx->addForeignKeyConstraint($journal, array("journal_id"), array("id"), array(

            "onUpdate" => "CASCADE"
        ));

        $trx->addForeignKeyConstraint($entry, array("entry_id"), array("id"), array(

            "onUpdate" => "CASCADE"
        ));

        $trx->addForeignKeyConstraint($entryType, array("entry_type_id"), array("id"), array(

            "onUpdate" => "CASCADE"
        ));

        if($schema->hasTable("period"))
            $schema->dropTable("period");

        $period = $schema->createTable('period');
        $period->addColumn('id', 'integer', array('autoincrement' => true));
        $period->addColumn('start', 'date');
        $period->addColumn('end', 'date');
        $period->addColumn('status', 'string');
        $period->setPrimaryKey(array('id'));
	}

	/**
	* @param Schema $schema
	*/
	public function down(Schema $schema):void{

		$schema->dropTable("coa");
        $schema->dropTable("journal");
        $schema->dropTable("entry");
		$schema->dropTable("entry_type");
        $schema->dropTable("trx");
        $schema->dropTable("period");
	}
}