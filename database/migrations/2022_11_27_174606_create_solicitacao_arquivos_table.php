<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaoArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_arquivo');
            $table->string('versao');
            $table->string('departamento');
            $table->string('arquivo_original');
            $table->string('arquivo_pdf')->nullable();
            $table->date('data_criacao')->nullable();
            $table->date('data_administrador')->nullable();
            $table->string('solicitante')->nullable();
            $table->string('administrador')->nullable();
            $table->string('comentario_administrador')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacao_arquivos');
    }
}
