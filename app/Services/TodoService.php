<?php

namespace App\Services;

use App\Models\Todo;

class TodoService
{

        public function create($info)
        {
            $todo = new Todo();
            $data = [
                'title' => $info['title'],
                'description' => $info['description'],
            ];
            // create
            return $todo->create($data);
        }
}
