<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardCard extends Model
{
    protected $table = "board_card";

    protected $fillable = [
        'board_id', 'user_id', 'list_id', 'card_title',
    ];

    public function createCard($input, $user_id)
    {
    	return BoardCard::create([
            'board_id' => $input->get('board_id'),
            'user_id' => $user_id,
            'list_id' => $input->get('list_id'),
            'card_title' => $input->get('card-title'),  
        ]);
    }

    public function updateCardListid($input)
    {
        return BoardCard::where('id', $input->get('cardId'))->update(['list_id' => $input->get('listId')]);
    }

    public function deleteCard($input)
    {
    	$card = BoardCard::find($input->get("cardId"));
    	BoardCard::find($input->get("cardId"))->delete();
    	return $card;
    }

    public function getCard($cardId)
    {
    	return BoardCard::findOrFail($cardId);
    }

    public function updateCard($input)
    {
    	BoardCard::where('id', $input->get("cardId"))->update([
            "card_title" => $input->get("cardName"),
            "card_description" => ($input->get("cardDescription") != "Empty") ? $input->get("cardDescription") : '',
            "card_color" => $input->get("cardColor"),
            "due_date" => date("Y-m-d H:i:s", strtotime($input->get("cardDueDate"))),
        ]);
        return true;
    }
}
