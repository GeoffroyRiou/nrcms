<?php

namespace GeoffroyRiou\NrCMS\Fields;

use Filament\Forms\Components\Builder;
use GeoffroyRiou\NrCMS\Services\BlocksService;

class PageBuilder extends Builder
{
    /**
     * Configure le schéma du formulaire pour le PageBuilder.
     *
     * Cette méthode initialise le schéma du formulaire en ajoutant divers composants
     * tels que des champs de texte, des champs de sélection, un éditeur enrichi, des
     * interrupteurs de basculement et des répétiteurs. Le schéma est défini en utilisant
     * la classe Builder\Block et ses composants de schéma correspondants.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->addActionLabel(__('Add a block'))
            ->blockNumbers(false)
            ->blockPickerColumns(3)
            ->schema($this->loadBlocksSchema())
            ->collapsible()
            ->cloneable()
            ->collapsed();
    }

    protected function loadBlocksSchema(): array
    {
        $blocksService = new BlocksService();
        return $blocksService->getAllBlocks();
    }
}
