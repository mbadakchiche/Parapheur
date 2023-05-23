<?php

return [
    'menu_title'=>'Mails Administration ',

    'singular' => 'Mail',
    'plural' => 'Mails',
    'draft' => 'Created Mails',
    'arrived'=> 'Arrived Mails',
    'income'=> 'In-coming Mails',
    'outcome'=> 'Out-coming Mails',
    'needprocess'=> 'Need Processing Mails',
    'needdispatch'=> 'Need Dispatching Mails',
    'fields' => [
        'id' => 'Id',
        'dossier_id' => 'Folder',
        'objet' => 'Objet',
        'ref' => 'Ref',
        'body' => 'Body',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'attachments' => 'Attachments',
        'mails'=>'Mails in this forlder'
    ],
    'button'=>[
        'view'=>'View',
        'send'=>'Send',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'record'=>'Record',
        'attach'=>'Attach to folder',
        'process'=>'Processing',
        'dispatch'=>'Dispatch',
    ],
];
