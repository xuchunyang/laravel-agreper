<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'forum_id',
        'user_id',
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return Comment[]
     */
    public function commentsFlatTree(): array
    {
        $data = $this->comments()->with('user')->get()->toArray();
        $tree = new \BlueM\Tree($data, ['rootId' => null, 'parent' => 'parent_id']);
        return array_map(function (\BlueM\Tree\Node $node) {
            $comment = Comment::with('user')->find($node->toArray()['id']);
            $comment->depth = count($node->getAncestors());
            return $comment;
        }, $tree->getNodes());
    }
}
