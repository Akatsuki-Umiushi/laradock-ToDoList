<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateTask;
use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask
{

    /**
     * リクエストに適用される検証ルールを取得します。
     *
     * @return array
     */
    public function rules()
    {   
        // CreateTaskモデルのrules()を取得
        $rule = parent::rules();
        
        // TasksモデルのSTATUSからin関数を使いルールを取得（1，2，3）
        $status_rule = Rule::in(array_keys(Task::STATUS));

        // requireにSTATUSルールをプラス
        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    // 挿入可能なデータの指定
    public function EditTaskAttributes()
    {   
        // CreateTaskモデルのCreateTaskAttributes()を取得
        $CreateTaskAttributes = parent::CreateTaskAttributes();
        
        // statusを追加
        return $CreateTaskAttributes + $this->only([
            'status',
        ]);
    }

    /**
     * エラーメッセージの日本語化
     */
    public function attributes()
    {   
        // CreateTaskモデルのattributes()を取得
        $attributes = parent::attributes();

        // statusを追加
        return $attributes + [
            'status' => '状態',
        ];
    }

    /**
     * オリジナルエラーメッセージ
     */
    public function messages()
    {   
        // CreateTaskモデルのmessages()を取得
        $messages = parent::messages();

        // array_mapを使い、TaskモデルのSTATUSからラベルを取得(未着手 着手中 完了)
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        // (未着手 着手中 完了)に「、」をつけてあげる
        $status_labels = implode('、', $status_labels);

        // 「状態 には 未着手、着手中、完了 のいずれかを指定してください。」
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }

    
}
