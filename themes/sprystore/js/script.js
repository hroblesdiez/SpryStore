

        const cleanSearchButton = document.querySelector('.search-icon-clean');
        const inputSearch = document.querySelector('#input-search');
        let $hiddenCleanButton = true;

        inputSearch.addEventListener ('input', toggleCleanButton); 

        function toggleCleanButton() {
            if($hiddenCleanButton) {
            cleanSearchButton.classList.add('visible');
            $hiddenCleanButton =false;
            } 
        }

        cleanSearchButton.addEventListener('click', cleanInput);

        function cleanInput() {
            if( !$hiddenCleanButton ) {
            inputSearch.value = '';
            inputSearch.focus();
        }
    }  
        document.addEventListener ('DOMContentLoaded', showCleanButton); 
    
        function showCleanButton() {
            if(inputSearch.value !== '' && $hiddenCleanButton == true) {
                cleanSearchButton.classList.add('visible');
                $hiddenCleanButton =false;
            }
        }
        // Open/Close Modal Windo 30% Off
        const openModalButton = document.querySelector('.details');
        const closeModalButton = document.querySelector('.modal__close');
        const modal = document.querySelector('#exampleModal');
        const body = document.querySelector('body');

        openModalButton.addEventListener('click', openModal);
        closeModalButton.addEventListener('click', closeModal);

        document.addEventListener ('click', (e) => {
            // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
            if (e.target.matches('.modal__close') || (!e.target.matches('.details')) && e.target.matches('#exampleModal')) {
                closeModal();
            }
        }, false);

        function openModal(e) {
            //e.preventDefault();
            modal.classList.add('modal-container-off--active');
            body.style.overflow = 'hidden';
        }
        function closeModal() {
            
            modal.classList.remove('modal-container-off--active');
            body.style.overflow = 'visible';
        }
