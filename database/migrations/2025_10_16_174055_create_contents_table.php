    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('language_id')
                  ->constrained('languages')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

       DB::statement('ALTER TABLE contents ADD FULLTEXT fulltext_title_content (title, content)')->execute();

    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
