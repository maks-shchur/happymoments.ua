<?php
class SitemapController extends Controller
{
    public function actionIndex()
    {
        $urls = array();
 
        // Actions
        $urls[] = $this->createUrl('actions/index');
        $actions = Actions::model()->findAll('t.picture != "" AND t.date_end <= '.date('Y-m-d'));        
        if(count($actions)>0)
        {
            foreach ($actions as $action) {
                $urls[] = $this->createUrl('actions/view', array('id'=>$action->id));
            }
        }
        
        // Tenders
        $urls[] = $this->createUrl('tenders/index');
        $tenders = Tenders::model()->findAll('t.date_end <= '.date('Y-m-d'));        
        if(count($tenders)>0)
        {
            foreach ($tenders as $tender) {
                $urls[] = $this->createUrl('tenders/view', array('id'=>$tender->id));
            }
        }
        
        // Freefoto
        $urls[] = $this->createUrl('freefoto/index');

        // Static Pages
        $urls[] = $this->createUrl('page/hmagent');
        $urls[] = $this->createUrl('page/advertisment');
        $urls[] = $this->createUrl('page/help_us');
        $urls[] = $this->createUrl('page/about');
        $urls[] = $this->createUrl('page/accounts');
        
        // News
        $urls[] = $this->createUrl('page/news');
        $news = News::model()->findAll('t.title != "" AND t.intro_text != ""');        
        if(count($news)>0)
        {
            foreach ($news as $item) {
                $urls[] = $this->createUrl('page/news', array('id'=>$item->id));
            }
        }

        // Categories
        $cats = Occupation::model()->localized('ru')->findAll(
            array(
                'condition'=>'t.name!="" AND t.active=1',
                'order'=>'t.cat_id ASC',
        ));        
        if(count($cats)>0)
        {
            foreach ($cats as $cat) {
                $urls[] = $this->createUrl('/cat/view',array('id'=>'c'.$cat->id.'_'.Settings::toLatin($cat->name)));
            }
        }
        
        // Users
        $users = Users::model()->findAll('t.name!="" AND t.activate=1');        
        if(count($users)>0)
        {
            foreach ($users as $user) {
                if(($user->filesCount >= 4) || ($user->videosCount >= 4) || ($user->floCount >= 4))
                {
                    $urls[] = '/id'.$user->id;
                    
                    // Photo albums
                    if($user->occupation_id==1)
                    {
                        $alb=Portfolio::model()->findAllByAttributes(array('uid'=>$user->id, 'visible'=>1));
                        if(count($alb) > 0)
                        {
                            foreach($alb as $item)
                            {
                                if($item->filesCount > 0)
                                    $urls[] = $this->createUrl('user/album',array('id'=>$item->id));
                            }    
                        }
                    }
                    // Video albums
                    if($user->occupation_id==2)
                    {
                        $vid=Video::model()->findAllByAttributes(array('uid'=>$user->id, 'visible'=>1));
                        if(count($vid) > 0)
                        {
                            foreach($vid as $item)
                            {
                                if($item->filesCount > 0)
                                    $urls[] = $this->createUrl('user/videoalbum',array('id'=>$item->id));
                            }    
                        }
                    }            
                }
            }
        }
        
        // Photo albums
        $users_alb = Users::model()->findAll('t.name!="" AND t.activate=1 AND t.occupation_id=1');        
        if(count($users_alb)>0)
        {
            foreach ($users_alb as $user_alb) {
                if(($user_alb->filesCount >= 4) || ($user->videosCount >= 4) || ($user->floCount >= 4))
                    $urls[] = '/id'.$user->id;
            }
        }
        
        /*// Страницы
        $pages = Page::model()->findAll(array(
            'condition' => 't.public = 1';
        ));
        foreach ($posts as $page){
            $urls[] = $this->createUrl('page/view', array('alias'=>$page->alias));
        }
 
        // Новости
        $news = News::model()->findAll(array(
            'condition' => 't.public = 1';
        ));
        foreach ($news as $new){
            $urls[] = $this->createUrl('news/view', array('id'=>$new->id));
        }
 
        // Работы портфолио
        $works = Work::model()->findAll(array(
            'condition' => 't.public = 1';
        ));
        foreach ($works as $work){
            $urls[] = $this->createUrl('work/view', array('id'=>$work->id));
        }
 
        // Товары
        $products = Product::model()->findAll(array(
            'condition' => 't.public = 1 AND t.count > 0';
        ));
        foreach ($products as $product){
            $urls[] = $this->createUrl('product/view', array('category'=>$product->category->alias, 'id'=>$product->id));
        }
 
        // ...*/
 
        $host = Yii::app()->request->hostInfo;
 
        echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        echo '<url>
                <loc>' . $host . '</loc>
                <changefreq>daily</changefreq>
                <priority>0.5</priority>
            </url>';
        if(count($urls) > 0)
        {
            foreach ($urls as $url){
                echo '<url>
                    <loc>' . $host . $url . '</loc>
                    <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>';
            }
        }
        
        echo '</urlset>';   
        Yii::app()->end();            
    }
}
?>