<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProgressRepository;

class Progress extends Controller
{

  public function __construct(ProgressRepository $progressRepository)
  {
    $this->progressRepository = $progressRepository; 
  }

  public function setDocument(Request $request)
  {
    $progress = $request->input('progress');
    $this->progressRepository->setDocumentId($progress);
  }
}
