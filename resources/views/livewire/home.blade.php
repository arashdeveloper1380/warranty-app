<div>
    <div class="form-wrap">
		<div class="tabs">
            <h3 class="login-tab"><a href="#login-tab-content">استعلام گارانتی</a></h3>
			<h3 class="signup-tab"><a class="active" href="#signup-tab-content">ثبت نام گارانتی</a></h3>
		</div><!--.tabs-->


		<div class="tabs-content">


			<div id="signup-tab-content" class="active">
				<form class="signup-form">
					<input type="text" wire:model="name" class="input" placeholder="نام و نام خانوادگی">
					<input type="text" wire:model="phone" class="input" placeholder="موبایل">
					<input type="text" wire:model="state" class="input" placeholder="استان">
					<input type="text" wire:model="city" class="input" placeholder="شهر">
					<input type="text" wire:model="shop_name" class="input" placeholder="نام فروشگاه">
					<input type="text" wire:model="code" class="input" placeholder="سریال کد">
					<input type="button" class="button" value="ثبت گارانتی">
				</form>
			</div>

			<div id="login-tab-content">
				<form class="login-form" action="" method="post">
					<input type="text" wire:model="code" class="input" placeholder="سریال کد">
					<input type="button" class="button" value="استعلام گارانتی">
				</form>
			</div>

            
		</div>
	</div>
</div>
