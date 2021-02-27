<?php

namespace App\Http\Repositories;

use App\Progress;
use App\Order;
use App\Http\Models\Document;

class ProgressRepository
{
  protected $progress;
  protected $order;
  protected $document;

  public function __construct(Progress $progress, Order $order, Document $document)
  {
    $this->progress = $progress;
    $this->order = $order;
    $this->document = $document;
  }

  public function setDocumentId(array $progress)
  {
    $this->progress->insert([
      [
        'document_id' => $progress['document_id'],
      ]
    ]);
  }

  public function setOrderId(array $progress)
  {
    $this->progress->insert([
      [
        'order_id' => $progress['order_id'],
      ]
    ]);
  }
}

?>
