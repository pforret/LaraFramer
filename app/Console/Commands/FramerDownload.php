<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Translation\Extractor\PhpStringTokenParser;

class FramerDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'framer:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download photos from Picture RSS to local disk';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rss = config('laraframer.rss');
        $rss_cache = storage_path() . "/rss";
        if (!is_dir($rss_cache)) mkdir($rss_cache);
        $feed = new \SimplePie();
        $feed->set_cache_location($rss_cache);
        $feed->set_feed_url($rss);
        $feed->init();
        $items=$feed->get_items();
        if(!$items){
            $this->warn("No items in feed");
            return Command::FAILURE;
        }
        $this->withProgressBar($items,function(\SimplePie_Item $item){
            $enclosures=$item->get_enclosures();
            if($enclosures){
                foreach($enclosures as $enclosure){
                    $this->downloadIfNecessary($enclosure->get_link());
                }
            }
        });
        return Command::SUCCESS;
    }

    private function downloadIfNecessary(string $url){
        $allowed_extensions=[
            "jpg",
            "png",
            "gif",
            "webp",
        ];
        $name=basename($url);
        $extension=pathinfo($name,PATHINFO_EXTENSION);
        if(!in_array($extension,$allowed_extensions)) return false;
        $folder=config('laraframer.folder');
        if(!Storage::disk("public")->exists($folder)){
            Storage::disk("public")->makeDirectory($folder);
        }
        $local=sprintf("%s/%s",$folder,$name);
        if(!Storage::disk("public")->exists($local)){
            // copy remote file
            $stream=fopen($url,"r");
            Storage::disk("public")->writeStream($local,$stream);
            fclose($stream);
        }
        return true;
    }
}
