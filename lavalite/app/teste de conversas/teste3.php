
{

    public function run()
    {
        $iniciar = new teste();
    }

}

class teste
{
    public function init()
    {
        $iniciars = Conversas::where('nome_conversa', '=','OnboardingConversation')
        ->select(DB::raw("CONCAT(parte_1,pergunta,parte_2,resposta,parte_3,nome_prox,parte_4) AS teste"))
        ->pluck('teste')->toArray();

        $iniciar =  implode(" ",$iniciars);

        return eval($iniciar);

    }
}
