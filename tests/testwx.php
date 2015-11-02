<div id="content">

<p>本章将介绍如何使用 <a href="http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/tool-gii">Gii</a> 去自动生成 Web 站点常用功能的代码。使用 Gii 生成代码非常简单，只要按照 Gii 页面上的介绍输入正确的信息即可。</p>
<p>贯穿本章节，你将会学到：</p>
<ul><li>在你的应用中开启 Gii</li>
<li>使用 Gii 去生成活动记录类</li>
<li>使用 Gii 去生成数据表操作的增查改删（CRUD）代码</li>
<li>自定义 Gii 生成的代码</li>
</ul><h2>开始 Gii <span></span></h2>
<p><a href="http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/tool-gii">Gii</a> 是 Yii 中的一个<a href="http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/structure-modules">模块</a>。可以通过配置应用的 yii\base\Application::modules 属性开启它。通常来讲在 <code>config/web.php</code> 文件中会有以下配置代码：</p>
<pre><code class="language-php hljs"><span class="hljs-variable">$config</span> = [ ... ];

<span class="hljs-keyword">if</span> (YII_ENV_DEV) {
    <span class="hljs-variable">$config</span>[<span class="hljs-string">'bootstrap'</span>][] = <span class="hljs-string">'gii'</span>;
    <span class="hljs-variable">$config</span>[<span class="hljs-string">'modules'</span>][<span class="hljs-string">'gii'</span>] = <span class="hljs-string">'yii\gii\Module'</span>;
}
</code></pre>
<p>这段配置表明，如果当前是<a href="http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/concept-configurations#environment-constants">开发环境</a>，应用会包含 <code>gii</code> 模块，模块类是 yii\gii\Module。</p>
<p>如果你检查应用的<a href="http://www.yiichina.comhttp://www.yiichina.com/doc/guide/2.0/structure-entry-scripts">入口脚本</a> <code>web/index.php</code>，将看到这行代码将 <code>YII_ENV_DEV</code> 设为 true：</p>
<pre><code class="language-php hljs">defined(<span class="hljs-string">'YII_ENV'</span>) <span class="hljs-keyword">or</span> define(<span class="hljs-string">'YII_ENV'</span>, <span class="hljs-string">'dev'</span>);
</code></pre>
<p>鉴于这行代码的定义，应用处于开发模式下，按照上面的配置会打开 Gii 模块。你可以直接通过 URL 访问 Gii：</p>
<pre><code class="hljs groovy"><span class="hljs-string">http:</span><span class="hljs-comment">//hostname/index.php?r=gii</span>
</code></pre>
<blockquote><p>补充： 如果你通过本机以外的机器访问 Gii，请求会被出于安全原因拒绝。你可以配置 Gii 为其添加允许访问的 IP 地址：</p>
<pre><code class="language-php hljs"><span class="hljs-string">'gii'</span> =&gt; [
    <span class="hljs-string">'class'</span> =&gt; <span class="hljs-string">'yii\gii\Module'</span>,
    <span class="hljs-string">'allowedIPs'</span> =&gt; [<span class="hljs-string">'127.0.0.1'</span>, <span class="hljs-string">'::1'</span>, <span class="hljs-string">'192.168.0.*'</span>, <span class="hljs-string">'192.168.178.20'</span>] <span class="hljs-comment">// 按需调整这里</span>
],
</code></pre>
</blockquote>
<p><img src="http://www.yiichina.comhttp://www.yiichina.com/docs/guide/2.0/images/start-gii.png" alt="Gii"></p>
<h2>生成活动记录类 <span></span></h2>
<p>选择 “Model Generator” （点击 Gii 首页的链接）去生成活动记录类。并像这样填写表单：</p>
<ul><li>Table Name: <code>country</code></li>
<li>Model Class: <code>Country</code></li>
</ul><p><img src="http://www.yiichina.comhttp://www.yiichina.com/docs/guide/2.0/images/start-gii-model.png" alt="模型生成器"></p>
<p>然后点击 “Preview” 按钮。你会看到 <code>models/Country.php</code> 被列在将要生成的文件列表中。可以点击文件名预览内容。</p>
<p>如果你已经创建过同样的文件，使用 Gii 会覆写它，点击文件名旁边的 <code>diff</code> 能查看现有文件与将要生成的文件的内容区别。</p>
<p><img src="http://www.yiichina.comhttp://www.yiichina.com/docs/guide/2.0/images/start-gii-model-preview.png" alt="模型生成器预览"></p>
<p>想要覆写已存在文件，选中 “overwrite” 下的复选框然后点击 “Generator”。如果是新文件，只点击 “Generator” 就好。</p>
<p>接下来你会看到一个包含已生成文件的说明页面。如果生成过程中覆写过文件，还会有一条信息说明代码是重新生成覆盖的。</p>
<h2>生成 CRUD 代码 <span></span></h2>
<p>CRUD 代表增，查，改，删操作，这是绝大多数 Web 站点常用的数据处理方式。选择 Gii 中的 “CRUD Generator” （点击 Gii 首页的链接）去创建 CRUD 功能。本例 “country” 中需要这样填写表单：</p>
<ul><li>Model Class: <code>app\models\Country</code></li>
<li>Search Model Class: <code>app\models\CountrySearch</code></li>
<li>Controller Class: <code>app\controllers\CountryController</code></li>
</ul><p><img src="http://www.yiichina.comhttp://www.yiichina.com/docs/guide/2.0/images/start-gii-crud.png" alt="CRUD 生成器"></p>
<p>然后点击 “Preview” 按钮。你会看到下述将要生成的文件列表。</p>
<p>[[NEED THE IMAGE HERE / 等待官方补充图片]]</p>
<p>如果你之前创建过 <code>controllers/CountryController.php</code> 和 <code>views/country/index.php</code> 文件（在指南的使用数据库章节），选中 “overwrite” 下的复选框覆写它们（之前的文件没能全部支持 CRUD）。</p>
<h2>试运行 <span></span></h2>
<p>用浏览器访问下面的 URL 查看生成代码的运行：</p>
<pre><code class="hljs fortran">http://hostname/<span class="hljs-built_in">index</span>.php?r=country/<span class="hljs-built_in">index</span>
</code></pre>
<p>可以看到一个栅格显示着从数据表中读取的国家数据。支持在列头对数据进行排序，输入筛选条件进行筛选。</p>
<p>可以浏览详情，编辑，或删除栅格中的每个国家。还可以点击栅格上方的 “Create Country” 按钮通过表单创建新国家。</p>
<p><img src="http://www.yiichina.comhttp://www.yiichina.com/docs/guide/2.0/images/start-gii-country-grid.png" alt="国家的数据栅格"></p>
<p><img src="http://www.yiichina.com/docs/guide/2.0/images/start-gii-country-update.png" alt="编辑一个国家"></p>
<p>下面列出由 Gii 生成的文件，以便你研习功能和实现，或修改它们。</p>
<ul><li>控制器：<code>controllers/CountryController.php</code></li>
<li>模型：<code>models/Country.php</code> 和 <code>models/CountrySearch.php</code></li>
<li>视图：<code>views/country/*.php</code></li>
</ul><blockquote><p>补充：Gii 被设计成高度可定制和可扩展的代码生成工具。使用它可以大幅提高应用开发速度。请参考 <a href="http://www.yiichina.com/doc/guide/2.0/tool-gii">Gii</a> 章节了解更多内容。</p>
</blockquote>
<h2>总结 <span></span></h2>
<p>本章学习了如何使用 Gii 去生成为数据表中数据实现完整 CRUD 功能的代码。</p>
		</div>