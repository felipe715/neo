<?php


namespace App\Repositories;


use App\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function save(array $data): Document
    {
        $doc = new Document();
        $doc->type = $data['type'];
        $doc->number = $data['number'];
        $doc->blacklist = $data['blacklist'];
        $doc->save();

        return $doc;
    }
    
    public function findBy(array $data)
    {
        $query = Document::query();

        if(isset($data['type'])){
            $query->where('type', $data['type']);
        }
        if(isset($data['number'])){
            $query->where('number', $data['number']);
        }
        if(isset($data['blacklist'])){
            $query->where('blacklist', '=', $data['blacklist']);
        }

        return $query->paginate(10);
    }

    public function findById($id): Document
    {
        return Document::find($id);
    }

    public function update(array $data, $id): Document
    {
        $doc = Document::find($id);
        $doc->type = $data['type'];
        $doc->number = $data['number'];
        $doc->blacklist = $data['blacklist'];
        $doc->update();

        return $doc;
    }

    public function delete($id):bool
    {
        return Document::find($id)->delete();
    }

}