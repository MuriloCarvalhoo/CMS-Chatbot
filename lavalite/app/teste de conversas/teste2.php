


    public function askName()
    {
        $this->ask('Preciso de algumas informações sobre você </br> </br> Qual o seu nome completo ?', function(Answer $answer) {
            $this->bot->userStorage()->save([
                'name' => $answer->getText(),
            ]);
            
            $this->name = $answer->getText();

            $this->say('Prazer em conhecê-lo '. $answer->getText());
            $this->askCpf();
        });
    }

    public function askCpf()
    {
        $this->ask('Qual o seu CPF?', function(Answer $answer){

            $validator = Validator::make(['Cpf' => $answer->getText()], [
                'Cpf' => 'Cpf',
            ]);

            if ($validator->fails()) {
                return $this->repeat('Isso não parece ser um CPF válido. Por favor digite um numero de CPF válido.');
            }

            $this->bot->userStorage()->save([
                'Cpf' => $answer->getText(),
            ]);

            $this->say('CPF válido '. $answer->getText());
            $this->askEmail();

            });
    }

    public function askEmail()
    {
        $this->ask('Qual seu e-mail?', function(Answer $answer) {

            $validator = Validator::make(['email' => $answer->getText()], [
                'email' => 'email',
            ]);

            if ($validator->fails()) {
                return $this->repeat('Isso não parece ser um e-mail válido. Por favor digite um email válido.');
            }

            $this->bot->userStorage()->save([
                'email' => $answer->getText(),
            ]);

            $this->say('Email válido '. $answer->getText());
            $this->askMobile();
        });
    }

    public function askMobile()
    {
        $this->ask('Excelente. Qual o número do seu celular?', function(Answer $answer) {

            $validator = Validator::make(['mobile' => $answer->getText()], [
                'celular_com_ddd' => 'celular_com_ddd'
            ]);

            if ($validator->fails()) {
                return $this->repeat('Isso não parece ser um numero de celular válido. Por favor digite um numero válido.');
            }
            $this->bot->userStorage()->save([
                'celular_com_ddd' => $answer->getText(),
            ]);

            $this->say('Excelente!');
            $this->saveSimulacao();

        });
    }



    public function saveSimulacao() 
    {
        //Pegar conversa atual e salvar em variaveis
        $userStorage = $this->bot->userStorage()->find();
        $name = $userStorage->get('name');
        $Cpf = $userStorage->get('Cpf');
        $email = $userStorage->get('email');
        $celular_com_ddd = $userStorage->get('celular_com_ddd');
        $ipAddr = $_SERVER["REMOTE_ADDR"];

        //Save in database
        $simulacao = new SimulacaoEmprestimo;
        $simulacao->name = $name;
        $simulacao->Cpf = $Cpf;
        $simulacao->email = $email;
        $simulacao->celular_com_ddd = $celular_com_ddd;
        $simulacao->ip_address = $ipAddr;
        $simulacao->save();

        $this->bot->userStorage()->delete();


    }

    public function run()
    {
        $this->askName();
    }
}