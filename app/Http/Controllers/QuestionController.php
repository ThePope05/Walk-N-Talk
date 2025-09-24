<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show($category)
    {
        $questions = match($category) {
            'icebreakers' => [
                'Wat is je favoriete seizoen en waarom?',
                'Welke app gebruik je het meest op je telefoon?',
                'Wat zou je doen als je de loterij wint?',
                'Ben je meer een koffie- of theedrinker?',
                'Wat is je favoriete bordspel of kaartspel?',
                'Wat is de beste film die je ooit hebt gezien?',
                'Welke muziek zet je op om in een goede stemming te komen?',
                'Wat is je favoriete comfort food?',
                'Welke feestdag of traditie vind je het leukst?',
                'Ben je meer een ochtendmens of een nachtbraker?',
                'Waar zou je het liefst ooit nog eens naartoe willen reizen?',
                'Wat is je mooiste vakantieherinnering?',
                'Hou je meer van strand of van bergen?',
                'Als je een roadtrip mocht maken, waar zou je heen gaan?',
                'Welke stad zou je iedereen aanraden om te bezoeken?',
                'Hoe zag je eerste bijbaan eruit?',
                'Wat vond je het leukste vak op school?',
                'Werk je liever in stilte of met muziek op de achtergrond?',
                'Wat motiveert je het meest om dingen gedaan te krijgen?',
                'Wat zou je willen leren als je daar tijd voor had?',
                'Als je een superkracht mocht kiezen, welke zou het zijn?',
                'Welke foute hit zing je stiekem mee?',
                'Zou je liever kunnen vliegen of teleporteren?',
                'Wat is de raarste gewoonte die je hebt?',
                'Welke emoji gebruik je het meest?',
                'Als je een dag iemand anders mocht zijn, wie zou je kiezen?',
                'Wat is het gekste dat je ooit gegeten hebt?',
                'Welke drie dingen neem je mee naar een onbewoond eiland?',
                'Als je een boek of film mocht herschrijven, welke zou dat zijn?',
                'Wat is een kleine dagelijkse gewoonte waar je blij van wordt?'
            ],
            'deeptalk' => [
                'Wat is een ervaring die je leven voorgoed heeft veranderd?',
                'Waar ben je het meest trots op in je leven?',
                'Wat betekent geluk voor jou?',
                'Welke angst heeft de meeste invloed op je keuzes?',
                'Wat is een les die je pas later in je leven hebt geleerd?',
                'Hoe ga je om met teleurstelling of verlies?',
                'Wat waardeer je het meest in vriendschappen?',
                'Welke droom of ambitie heb je nog nooit verteld aan iemand?',
                'Wat betekent succes voor jou persoonlijk?',
                'Wanneer voel je je het meest authentiek?',
                'Wat is een herinnering die je altijd bij zal blijven?',
                'Hoe zou je je perfecte dag beschrijven?',
                'Wat betekent liefde voor jou?',
                'Welke overtuiging of gedachtepatroon wil je graag loslaten?',
                'Wat is iets wat je nog wilt bereiken in je leven?',
                'Welke gebeurtenis heeft je kijk op de wereld veranderd?',
                'Wat vind je moeilijk om over te praten, maar wil je toch delen?',
                'Wat is een eigenschap die je bewondert in anderen?',
                'Wat is een beslissing waar je nog steeds over nadenkt?',
                'Hoe ga je om met stress of moeilijke periodes?',
                'Wat betekent vriendschap voor jou?',
                'Wat is een moment waarop je jezelf echt overwonnen hebt?',
                'Hoe zou je willen dat mensen zich jouw herinneren?',
                'Wat is iets dat je recentelijk heeft laten groeien als persoon?',
                'Welke waarde of principe is voor jou het belangrijkste in het leven?',
                'Wat is een geheim van je dat je nog nooit aan iemand hebt verteld?',
                'Wat is een ervaring die je begrip voor anderen heeft vergroot?',
                'Waar heb je spijt van en wat heb je ervan geleerd?',
                'Wat is iets dat je diep inspireert?',
                'Hoe definieer je innerlijke rust of tevredenheid?'
            ],
            'jokes' => [
                'Als je een dier kon zijn voor een dag, welk dier zou je kiezen en waarom?',
                'Wat is de meest belachelijke gewoonte die je hebt?',
                'Welke foute hit zing je stiekem altijd mee?',
                'Wat is het raarste eten dat je ooit hebt geprobeerd?',
                'Als je een superkracht mocht hebben die totaal nutteloos is, welke zou dat zijn?',
                'Wat is je slechtste dansmove?',
                'Welke film of serie schaam je je om leuk te vinden?',
                'Wat is het grappigste dat je recent hebt meegemaakt?',
                'Als je een dag beroemd mocht zijn om iets doms, wat zou je doen?',
                'Wat is de meest onhandige situatie waarin je ooit zat?',
                'Wat is een slechte grap die je eigenlijk hilarisch vindt?',
                'Als je elke dag één gek geluid moest maken, welk geluid zou dat zijn?',
                'Wat is de meest vreemde droom die je ooit had?',
                'Welke cartoon of kinderfilm vond je als volwassene nog steeds leuk?',
                'Als je een zin kon kiezen die altijd in je hoofd blijft, welke zou dat zijn?',
                'Wat is de meest bizarre trend die je ooit gevolgd hebt?',
                'Wat is een uitspraak die je altijd verkeerd zegt?',
                'Als je een willekeurige taal kon spreken maar alleen met dieren, welke taal zou dat zijn?',
                'Wat is je slechtste poging tot koken ooit?',
                'Als je een willekeurig voorwerp tot leven kon brengen, welk voorwerp zou dat zijn en waarom?',
                'Wat is de raarste bijnaam die je ooit hebt gehad?',
                'Als je een meme kon worden, welke zou dat zijn?',
                'Wat is iets dat je doet waarvan anderen altijd lachen?',
                'Welke fictieve persoon zou je uitnodigen voor een feestje?',
                'Wat is een belachelijke angst die je hebt (of had)?',
                'Als je een dag in een cartoonwereld mocht leven, welke zou je kiezen?',
                'Wat is een woord dat je altijd verkeerd uitspreekt?',
                'Wat is het meest absurde dat je ooit hebt gekocht?',
                'Als je een dansmove moest verzinnen met een alledaags object, wat zou het zijn?',
                'Wat is een rare gewoonte die je zou willen uitleggen, maar niemand zou begrijpen?'
            ],
            default => [],
        };

        return view('questions', [
            'category' => $category,
            'questions' => $questions
        ]);
    }
}
