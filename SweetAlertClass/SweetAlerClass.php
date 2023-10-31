<?php
class Notification
{
    private $title = '';
    private $message = '';
    private $type = '';
    private $showConfirmButton = false;
    private $confirmButtonText = 'OK';
    private $showCancelButton = false;
    private $cancelButtonText = 'Cancelar';
    private $position = 'center';
    private $timer = null;
    private $timerProgressBar = false;
    private $footer = '';
    private $html = '';
    private $confirmButtonColor = '';
    private $cancelButtonColor = '';
    private $onConfirmCallback = null;
    private $onCancelCallback = null;
    private $reverseButtons = false;
    private $imageUrl = '';
    private $imageWidth = 400;
    private $imageHeight = 200;
    private $imageAlt = 'Imagem do sistema';

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function confirmButtonText($text)
    {
        $this->showConfirmButton = true;
        $this->confirmButtonText = $text;
        return $this;
    }

    public function confirmButtonColor($confirmButtonColor)
    {
        $this->confirmButtonColor = $confirmButtonColor;
        return $this;
    }

    public function cancelButtonText($text)
    {
        $this->showCancelButton = true;
        $this->cancelButtonText = $text;
        return $this;
    }

    public function reverseButtons($reverseButtons)
    {
        $this->reverseButtons = $reverseButtons;
        return $this;
    }

    public function cancelButtonColor($cancelButtonColor)
    {
        $this->cancelButtonColor = $cancelButtonColor;
        return $this;
    }

    public function position($position)
    {
        $this->position = $position;
        return $this;
    }

    public function timer($timer)
    {
        $this->timer = $timer;
        return $this;
    }
	
	public function timerProgressBar($timerProgressBar)
    {
        $this->timerProgressBar = $timerProgressBar;
        return $this;
    }

    public function footer($footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function html($html)
    {
        $this->html = $html;
        return $this;
    }

    public function onConfirm($callback)
    {
        $this->onConfirmCallback = $callback;
        return $this;
    }

    public function onCancel($callback)
    {
        $this->onCancelCallback = $callback;
        return $this;
    }

    public function imageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function imageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;
        return $this;
    }

    public function imageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;
        return $this;
    }

    public function imageAlt($imageAlt)
    {
        $this->imageAlt = $imageAlt;
        return $this;
    }

    public function show()
    {
        ?>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
				const isTimerProgressBar = '<?= $this->timerProgressBar ?>';
				
				if (isTimerProgressBar) {
					let timerInterval
					Swal.fire({
					  title: '<?= $this->title ?>',
					  html: '<?= $this->html ?>',
					  timer: '<?= $this->timer ?>',
					  timerProgressBar: true,
					  didOpen: () => {
						Swal.showLoading()
						const b = Swal.getHtmlContainer().querySelector('b')
						timerInterval = setInterval(() => {
						  b.textContent = Swal.getTimerLeft()
						}, 100)
					  },
					  willClose: () => {
						clearInterval(timerInterval)
						  console.log('Fechou')
					  }
					}).then((result) => {
					  /* Read more about handling dismissals below */
					  if (result.dismiss === Swal.DismissReason.timer) {
						console.log('I was closed by the timer')
					  }
					})
				} else {
					Swal.fire({
						title: '<?= $this->title ?>',
						text: '<?= $this->message ?>',
						html: '<?= $this->html ?>',
						icon: '<?= $this->type ?>',
						position: '<?= $this->position ?>',
						timer: '<?= $this->timer ?>',
						footer: '<?= $this->footer ?>',
						imageUrl: '<?= $this->imageUrl ?>',
						imageWidth: '<?= $this->imageWidth ?>',
						imageHeight: '<?= $this->imageHeight ?>',
						imageAlt: '<?= $this->imageAlt ?>',
						showConfirmButton: <?= $this->showConfirmButton ? 'true' : 'false' ?>,
						confirmButtonText: '<?= $this->confirmButtonText ?>',
						showCancelButton: <?= $this->showCancelButton ? 'true' : 'false' ?>,
						cancelButtonText: '<?= $this->cancelButtonText ?>',
						confirmButtonColor: '<?= $this->confirmButtonColor ?>',
						cancelButtonColor: '<?= $this->cancelButtonColor ?>',
						reverseButtons: <?= $this->reverseButtons ? 'true' : 'false' ?>
					}).then((result) => {
						if (result.value) {
							<?= $this->onConfirmCallback ?? '' ?>
						} else {
							<?= $this->onCancelCallback ?? '' ?>
						}
					});		
				}
            });
        </script>
        <?php
    }
}

function sweetAlert()
{
    return new Notification();
}
?>