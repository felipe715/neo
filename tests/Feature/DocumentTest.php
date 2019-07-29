<?php

namespace Tests\Feature;

use App\Document;
use App\Repositories\DocumentRepository;
use App\Repositories\DocumentRepositoryInterface;
use App\Services\DocumentService;
use PhpParser\Node\Expr\Cast\Object_;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @expectedException Exception
     */
    public function testInsertDocumentWithInvalidCpf()
    {
        $d = new DocumentService(new DocumentRepository());
        $d->save(array('type' => 'cpf', 'number' => '300121212', 'blacklist' => true));
    }

    /**
     * @expectedException Exception
     */
    public function testInsertDocumentWithInvalidCnpj()
    {
        $d = new DocumentService(new DocumentRepository());
        $d->save(array('type' => 'cnpj', 'number' => '300121212', 'blacklist' => true));
    }

    public function testInsertValidCpf()
    {
        $repository = $this->createMock('App\Repositories\DocumentRepository');
        $repository->method('findBy')->willReturn(array());

        $d = new DocumentService($repository);
        $this->assertIsObject($d->save(array('type' => 'cpf', 'number' => '30007224915', 'blacklist' => true)));
    }

    /**
     * @expectedException Exception
     */
    public function testInsertDuplicateCpf()
    {
        $repository = $this->createMock('App\Repositories\DocumentRepository');
        $repository->method('findBy')->willReturn(array('type' => 'cpf', 'number' => '30007224915', 'blacklist'));
        $d = new DocumentService($repository);
        $d->save(array('type' => 'cpf', 'number' => '30007224915', 'blacklist' => true));
    }
}
