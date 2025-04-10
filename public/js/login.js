// Adiciona efeito de foco nos campos de input
        document.querySelectorAll('.input-control input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.querySelector('.input-icon').style.color = '#4361ee';
            });

            input.addEventListener('blur', function() {
                this.parentNode.querySelector('.input-icon').style.color = '#7a7a7a';
            });
        });