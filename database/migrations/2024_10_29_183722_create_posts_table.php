            <?php

            use Illuminate\Database\Migrations\Migration;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Support\Facades\Schema;

            return new class extends Migration
            {
                /**
                 * Run the migrations.  
                 */
                public function up(): void
                {
                    Schema::create('posts', function (Blueprint $table) {
                        $table->id();
                        //foreign ref to user's id  
                        $table->string('topic');
                        $table->string('body');
                        $table->bigInteger('chat_user_id')->unsigned();
                        $table->foreign('chat_user_id')->references('id')->on('chat_users')
                            ->onDelete('cascade')->onUpdate('cascade');
                        $table->timestamps();
                    });
                }

                /**
                * Reverse the migrations.
                */
                public function down(): void
                {
                    Schema::dropIfExists('posts');
                }
            };
