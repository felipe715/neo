<?php


namespace App\Services;


use App\Document;
use App\Repositories\DocumentRepositoryInterface;
use App\Utils;

class DocumentService
{
    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function save(array $data): Document
    {
        if(count($this->documentRepository->findBy(array('number'=> $data['number']))) > 0){
            throw new \Exception('CPF/CNPJ already registered');
        }
        if($data['type'] == 'cpf'){
            if(!Utils::validateCpf($data['number'])){
                throw new \Exception('Invalid CPF');
            }
        }elseif (!Utils::validateCnpj($data['number'])){
            throw new \Exception('Invalid CNPJ');
        }

        return $this->documentRepository->save($data);
    }

    public function findBy(array $data)
    {
        return $this->documentRepository->findBy($data);
    }

    public function findById($id)
    {
        return $this->documentRepository->findById($id);
    }

    public function update(array $data, $id): Document
    {
        if($data['type'] == 'cpf'){
            if(!Utils::validateCpf($data['number'])){
                throw new \Exception('Invalid CPF');
            }
        }elseif (!Utils::validateCnpj($data['number'])){
            throw new \Exception('Invalid CNPJ');
        }

        return $this->documentRepository->update($data, $id);
    }

    public function delete($id):bool
    {
        return $this->documentRepository->delete($id);
    }

}