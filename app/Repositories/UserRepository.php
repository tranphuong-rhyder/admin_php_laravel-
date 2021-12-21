<?php

namespace App\Repositories;

class UserRepository extends Repository {

    public function __construct() {
        parent::__construct(new \App\Models\Users());
        $this->fields = ['id', 'name', 'password', 'email', 'status', 'gender','email_verified_at','status', 'role', 'remember_token', 'created_at', 'updated_at'];
        $this->primaryKey = 'id';
    }

    public function format($record) {
        $record->status_str = config('apps.user.status_str')[$record->status];

        $record->gender_str = config('apps.user.gender_str')[$record->gender];

        return $record;
    }

    public function formatAllRecord($records) {
        foreach($records as $record) {
            $record = $this->format($record);
        }
        return $records;
    }
}
?>
