<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use App\Models\User;
use App\Models\Departamento;
use App\Models\Solicitacao_arquivo;
use App\Models\Conta_arquivos_departamento;
use App\Models\Visualizacao_documento;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class RelatorioController extends Controller
{
    public function index(){

        $relatorios = Arquivo::all();

        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $arquivos_aprovados = Solicitacao_arquivo::where('status','=', 'Aprovado')->get()->count();
        $arquivos_reprovados = Solicitacao_arquivo::where('status','=', 'Recusado')->get()->count();
        #dd($arquivos_aprovados);
        $departamentos = Departamento::all();
        $delete = Conta_arquivos_departamento::truncate();
        foreach ($departamentos as $departamento) {
            $nome_departamento = $departamento->nome;
            $arquivos = Arquivo::where('departamento','=', $departamento->id)->get()->count();
            #dd($arquivos);

            $arquivo = new Conta_arquivos_departamento;

            $arquivo->nome_departamento = $departamento->nome;
            $arquivo->qtd_arquivos = $arquivos;
            $arquivo->save();

        }

        $contador_arquivos_departamento = Conta_arquivos_departamento::all();
        $lista1 = [];
        foreach ($contador_arquivos_departamento as $contador) {
            $nome_departamento = $contador->nome_departamento;
            $arquivos = $contador->qtd_arquivos;
            $lista1[$nome_departamento] = $arquivos;
            #print($nome_departamento);
            #print($arquivos);

        }
        #dd($lista1["Tecnologia da Informação"]);
        $departamento_nome = [ implode(',', array_keys($lista1))];
        $dados = [ implode(',', $lista1)];
        #dd($departamento_nome[0]);

        $visualizacoes = Visualizacao_documento::all();
        #dd($visualizacoes);
        $nome_arquivo2 = [];
        $qtd_visualizacao = [];
        foreach ($visualizacoes as $visualizacao) {
            $nome_arquivo = $visualizacao->nome_arquivo;
            $qtd = $visualizacao->qtd_visualizacao;
            $nome_arquivo2[] = $nome_arquivo;
            $qtd_visualizacao[] = $qtd;
            #print($nome_arquivo.'-'.$qtd.'<br/>');

        }


        $chart = (new LarapexChart)->horizontalBarChart()
            ->setTitle('Quantidade de Arquivos Aprovados e Recusados')
            ->setSubtitle('Arquivos aprovados e recusados pelo administrador do sistema.')
            ->setColors(['#008000', '#FF0000'])
            ->addData('Arquivos Aprovados', [$arquivos_aprovados])
            ->addData('Arquivos Recusados', [$arquivos_reprovados])
            ->setLabels(['Aprovados', 'Recusados']);
        
        $chart2 = (new LarapexChart)->barChart()
            ->setTitle('Quantidade de Arquivos por Departamento')
            ->setSubtitle('Arquivos aprovados por departamento cadastrado no sistema.')
            ->setColors(['#D32F2F', '#000000','#0000FF','#8B4513'])
            ->addData('Tecnologia da Informação', [$lista1["Tecnologia da Informação"]])
            ->addData('Qualidade', [$lista1["Qualidade"]])
            ->addData('Produção', [$lista1["Produção"]])
            ->addData('Segurança do Trabalho', [$lista1["Segurança do Trabalho"]])
            ->setLabels(['Tecnologia da Informação', 'Qualidade', 'Produção', 'Segurança do Trabalho']);

        $chart3 = (new LarapexChart)->radialChart()
            ->setTitle('Visualizações de arquivos')
            ->setSubtitle('Quantidade de visualizações por arquivo no sistema.')
            ->setColors(['#D32F2F', '#000000','#0000FF','#8B4513'])
            #->addData($nome_arquivo2[0], [$qtd_visualizacao[0]])
            #->addData($nome_arquivo2[1], [$qtd_visualizacao[1]])
            #->addData($nome_arquivo2[2], [$qtd_visualizacao[2]])
            ->addData([[$qtd_visualizacao[0]], [$qtd_visualizacao[1]], [$qtd_visualizacao[2]]])
            ->setLabels([$nome_arquivo2[0], $nome_arquivo2[1], $nome_arquivo2[2]]);

        return view('sgqdoc/relatorios', ['relatorios' => $relatorios, 'chart' => $chart, 'chart2' => $chart2, 'chart3' => $chart3]);

    }

}
