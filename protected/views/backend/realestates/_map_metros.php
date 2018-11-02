<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td class="Image_map">
        <div class="Map_metro">
          <img src="/images/map_metro.png" usemap="#ImageMap" />
          <map name="ImageMap" id="ImageMap" >
          <?php foreach( $metros["stations"] as $key => $station ) { ?>
            <area id="link_<?=$station->mapid;?>" onclick="chSt(this);return false;" alt="<?=$station->title;?>" href="#" coords="<?=$station->coords_map;?>" shape="<?=$station->shape_map;?>" />
          <?php } ?>

          <?/*
          <!-- lINE_1 -->
            <area id="link_126" onclick="chSt(this);return false;" alt="Планерная" href="#" coords="36,18,92,28" shape="rect" />
            <area id="link_157" onclick="chSt(this);return false;" alt="Сходненская" href="#" coords="24,28,92,38" shape="rect" />
            <area id="link_169" onclick="chSt(this);return false;" alt="Тушинская" href="#" coords="34,38,92,48" shape="rect" />
            <area id="link_191" onclick="chSt(this);return false;" alt="Щукинская" href="#" coords="32,48,92,58" shape="rect" />
            <area id="link_110" onclick="chSt(this);return false;" alt="Октябрьское поле" href="#" coords="8,58,92,68" shape="rect" />
            <area id="link_127" onclick="chSt(this);return false;" alt="Полежаевская" href="#" coords="20,68,92,278" shape="rect" />
            <area id="link_17" onclick="chSt(this);return false;" alt="Беговая" href="#" coords="45,78,92,88" shape="rect" />
            <area id="link_170" onclick="chSt(this);return false;" alt="Улица 1905 года" href="#" coords="13,88,92,98" shape="rect" />
            <area id="link_15" onclick="chSt(this);return false;" alt="Баррикадная" href="#" coords="107,217,180,227" shape="rect" />

            <area id="link_135" onclick="chSt(this);return false;" alt="Пушкинская" href="#" coords="160,261,224,271" shape="rect" />
            <area id="link_76" onclick="chSt(this);return false;" alt="Кузнецкий мост" href="#" coords="238,269,319,279" shape="rect" />
            <area id="link_158" onclick="chSt(this);return false;" alt="Таганская" href="#" coords="403,365,461,375" shape="rect" />
            <area id="link_131" onclick="chSt(this);return false;" alt="Пролетарская" href="#" coords="445,408,518,418" shape="rect" />
            <area id="link_41" onclick="chSt(this);return false;" alt="Волгоградский проспект" href="#" coords="480,582,573,592" shape="rect" />
            <area id="link_161" onclick="chSt(this);return false;" alt="Текстильщики" href="#" coords="480,592,573,602" shape="rect" />
            <area id="link_77" onclick="chSt(this);return false;" alt="Кузьминки" href="#" coords="480,602,573,612" shape="rect" />
            <area id="link_140" onclick="chSt(this);return false;" alt="Рязанский проспект" href="#" coords="480,612,573,622" shape="rect" />
            <area id="link_44" onclick="chSt(this);return false;" alt="Выхино" href="#" coords="480,622,573,632" shape="rect" /> 
          <!-- /lINE_1-->

          <!-- lINE_2 -->
            <area id="link_137" onclick="chSt(this);return false;" alt="Речной вокзал" href="#" coords="118,18,191,28" shape="rect" />
            <area id="link_39" onclick="chSt(this);return false;" alt="Водный стадион" href="#" coords="112,28,191,38" shape="rect" />
            <area id="link_40" onclick="chSt(this);return false;" alt="Войковская" href="#" coords="130,38,191,48" shape="rect" />
            <area id="link_148" onclick="chSt(this);return false;" alt="Сокол" href="#" coords="154,48,191,58" shape="rect" />
            <area id="link_12" onclick="chSt(this);return false;" alt="Аэропорт" href="#" coords="142,58,191,68" shape="rect" />
            <area id="link_49" onclick="chSt(this);return false;" alt="Динамо" href="#" coords="147,68,191,78" shape="rect" />
            <area id="link_18" onclick="chSt(this);return false;" alt="Белорусская" href="#" coords="157,196,228,206" shape="rect" />

            <area id="link_92" onclick="chSt(this);return false;" alt="Маяковская" href="#" coords="217,222,283,232" shape="rect" />
            <area id="link_159" onclick="chSt(this);return false;" alt="Тверская" href="#" coords="219,249,255,259" shape="rect" />
            <area id="link_160" onclick="chSt(this);return false;" alt="Театральная" href="#" coords="289,322,354,332" shape="rect" />
            <area id="link_104" onclick="chSt(this);return false;" alt="Новокузнецкая" href="#" coords="324,355,401,365" shape="rect" /> 
            <area id="link_115" onclick="chSt(this);return false;" alt="Павелецкая" href="#" coords="374,407,437,417" shape="rect" />
            <area id="link_5" onclick="chSt(this);return false;" alt="Автозаводская" href="#" coords="382,448,457,458" shape="rect" />
            <area id="link_65" onclick="chSt(this);return false;" alt="Коломенская" href="#" coords="382,458,447,468" shape="rect" />
            <area id="link_61" onclick="chSt(this);return false;" alt="Каширская" href="#" coords="382,468,439,478" shape="rect" />
            <area id="link_58" onclick="chSt(this);return false;" alt="Кантемировская" href="#" coords="311,584,390,594" shape="rect" />
            <area id="link_181" onclick="chSt(this);return false;" alt="Царицыно" href="#" coords="337,594,390,604" shape="rect" />
            <area id="link_111" onclick="chSt(this);return false;" alt="Орехово" href="#" coords="345,604,390,614" shape="rect" />
            <area id="link_52" onclick="chSt(this);return false;" alt="Домодедовская" href="#" coords="314,614,390,624" shape="rect" />
            <area id="link_69" onclick="chSt(this);return false;" alt="Красногвардейская" href="#" coords="297,623,391,633" shape="rect" />
         <!-- /lINE_2-->
                                                        
         <!-- lINE_3 -->
            <area id="link_9" onclick="chSt(this);return false;" alt="Алтуфьево" href="#" coords="257,18,311,28" shape="rect" />
            <area id="link_21" onclick="chSt(this);return false;" alt="Бибирево" href="#" coords="257,28,306,38" shape="rect" />
            <area id="link_112" onclick="chSt(this);return false;" alt="Отрадное" href="#" coords="257,38,306,48" shape="rect" />

            <area id="link_38" onclick="chSt(this);return false;" alt="Владыкино" href="#" coords="257,48,314,58" shape="rect" />
            <area id="link_121" onclick="chSt(this);return false;" alt="Петровско-Разумовская" href="#" coords="257,88,321,98" shape="rect" />
            <area id="link_163" onclick="chSt(this);return false;" alt="Тимирязевская" href="#" coords="257,127,331,137" shape="rect" />
            <area id="link_50" onclick="chSt(this);return false;" alt="Дмитровская" href="#" coords="257,137,325,147" shape="rect" />
            <area id="link_141" onclick="chSt(this);return false;" alt="Савёловская" href="#" coords="257,147,320,157" shape="rect" />
            <area id="link_95" onclick="chSt(this);return false;" alt="Менделеевская" href="#" coords="190,168,265,178" shape="rect" />
            <area id="link_182" onclick="chSt(this);return false;" alt="Цветной бульвар" href="#" coords="238,200,287,210" shape="rect" />
            <area id="link_185" onclick="chSt(this);return false;" alt="Чеховская" href="#" coords="225,260,286,270" shape="rect" />
            <area id="link_26" onclick="chSt(this);return false;" alt="Боровицкая" href="#" coords="232,376,296,386" shape="rect" />

            <area id="link_128" onclick="chSt(this);return false;" alt="Полянка" href="#" coords="281,426,327,436" shape="rect" />
            <area id="link_146" onclick="chSt(this);return false;" alt="Серпуховская" href="#" coords="281,455,355,465" shape="rect" />
            <area id="link_167" onclick="chSt(this);return false;" alt="Тульская" href="#" coords="241,506,290,516" shape="rect" />
            <area id="link_98" onclick="chSt(this);return false;" alt="Нагатинская" href="#" coords="227,516,290,526" shape="rect" />
            <area id="link_99" onclick="chSt(this);return false;" alt="Нагорная" href="#" coords="241,526,290,536" shape="rect" />
            <area id="link_100" onclick="chSt(this);return false;" alt="Нахимовский проспект" href="#" coords="205,536,290,546" shape="rect" />
            <area id="link_143" onclick="chSt(this);return false;" alt="Севастопольская" href="#" coords="206,546,290,556" shape="rect" />
            <area id="link_184" onclick="chSt(this);return false;" alt="Чертановская" href="#" coords="224,583,290,593" shape="rect" />
            <area id="link_194" onclick="chSt(this);return false;" alt="Южная" href="#" coords="251,593,290,603" shape="rect" />

            <area id="link_129" onclick="chSt(this);return false;" alt="Пражская" href="#" coords="237,603,290,613" shape="rect" />
            <area id="link_171" onclick="chSt(this);return false;" alt="Улица Академика Янгеля" href="#" coords="229,613,506,623" shape="rect" />
            <area id="link_10" onclick="chSt(this);return false;" alt="Аннино" href="#" coords="248,623,290,633" shape="rect" />
            <area id="link_29" onclick="chSt(this);return false;" alt="Бульвар Дмитрия Донского" href="#" coords="225,659,290,669" shape="rect" />
            <area id="link_175" onclick="chSt(this);return false;" alt="Улица Старокачаловская" href="#" coords="280,674,399,684" shape="rect" />
            <area id="link_174" onclick="chSt(this);return false;" alt="Улица Скобелевская" href="#" coords="280,689,380,699" shape="rect" />
            <area id="link_28" onclick="chSt(this);return false;" alt="Бульвар адм. Ушакова" href="#" coords="280,699,385,709" shape="rect" />
            <area id="link_172" onclick="chSt(this);return false;" alt="Улица Горчакова" href="#" coords="280,709,367,719" shape="rect" />
            <area id="link_32" onclick="chSt(this);return false;" alt="Бунинская аллея" href="#" coords="280,719,367,729" shape="rect" />  
         <!-- /lINE_3-->

         <!-- lINE_4 -->
            <area id="link_93" onclick="chSt(this);return false;" alt="Медведково" href="#" coords="382,18,442,28" shape="rect" />
            <area id="link_13" onclick="chSt(this);return false;" alt="Бабушкинская" href="#" coords="382,28,452,38" shape="rect" />
            <area id="link_142" onclick="chSt(this);return false;" alt="Свиблово" href="#" coords="382,38,432,48" shape="rect" />
            <area id="link_27" onclick="chSt(this);return false;" alt="Ботанический сад" href="#" coords="382,48,467,58" shape="rect" />
            <area id="link_37" onclick="chSt(this);return false;" alt="ВДНХ" href="#" coords="382,58,414,68" shape="rect" />
            <area id="link_8" onclick="chSt(this);return false;" alt="Алексеевская" href="#" coords="382,68,448,78" shape="rect" />
            <area id="link_138" onclick="chSt(this);return false;" alt="Рижская" href="#" coords="382,78,427,88" shape="rect" /> 
            <area id="link_134" onclick="chSt(this);return false;" alt="Проспект Мира" href="#" coords="343,190,417,200" shape="rect" />
            <area id="link_156" onclick="chSt(this);return false;" alt="Сухаревская" href="#" coords="289,222,353,232" shape="rect" />
            <area id="link_168" onclick="chSt(this);return false;" alt="Тургеневская" href="#" coords="343,263,413,275" shape="rect" />
            <area id="link_63" onclick="chSt(this);return false;" alt="Китай-город" href="#" coords="343,305,411,315" shape="rect" />
            <area id="link_164" onclick="chSt(this);return false;" alt="Третьяковская" href="#" coords="311,346,373,346,373,356,324,356,324,366,311,366" shape="poly" />
            <area id="link_109" onclick="chSt(this);return false;" alt="Октябрьская" href="#" coords="175,435,243,445" shape="rect" />
            <area id="link_189" onclick="chSt(this);return false;" alt="Шаболовская" href="#" coords="125,523,191,533" shape="rect" />
            <area id="link_83" onclick="chSt(this);return false;" alt="Ленинский проспект" href="#" coords="119,533,191,543" shape="rect" />
            <area id="link_6" onclick="chSt(this);return false;" alt="Академическая" href="#" coords="116,543,191,553" shape="rect" />

            <area id="link_132" onclick="chSt(this);return false;" alt="Профсоюзная" href="#" coords="123,553,191,563" shape="rect" />
            <area id="link_108" onclick="chSt(this);return false;" alt="Новые Черемушки" href="#" coords="110,563,191,573" shape="rect" />
            <area id="link_57" onclick="chSt(this);return false;" alt="Калужская" href="#" coords="135,573,191,583" shape="rect" />
            <area id="link_19" onclick="chSt(this);return false;" alt="Беляево" href="#" coords="148,583,191,593" shape="rect" />
            <area id="link_67" onclick="chSt(this);return false;" alt="Коньково" href="#" coords="141,593,191,603" shape="rect" />
            <area id="link_162" onclick="chSt(this);return false;" alt="Тёплый Стан" href="#" coords="132,603,191,613" shape="rect" />
            <area id="link_196" onclick="chSt(this);return false;" alt="Ясенево" href="#" coords="140,613,191,623" shape="rect" />
            <area id="link_25" onclick="chSt(this);return false;" alt="Новоясеневская" href="#" coords="108,623,191,633" shape="rect" />
        <!-- /lINE_4-->

        <!-- lINE_5 -->
            <area id="link_173" onclick="chSt(this);return false;" alt="Улица Подбельского" href="#" coords="482,18,577,28" shape="rect" />
            <area id="link_183" onclick="chSt(this);return false;" alt="Черкизовская" href="#" coords="482,28,551,38" shape="rect" />
            <area id="link_130" onclick="chSt(this);return false;" alt="Преображенская площадь" href="#" coords="482,38,572,48" shape="rect" />
            <area id="link_149" onclick="chSt(this);return false;" alt="Сокольники" href="#" coords="482,48,541,58" shape="rect" />
            <area id="link_71" onclick="chSt(this);return false;" alt="Красносельская" href="#" coords="482,58,561,68" shape="rect" />
            <area id="link_66" onclick="chSt(this);return false;" alt="Комсомольская" href="#" coords="376,215,456,225" shape="rect" />
            <area id="link_72" onclick="chSt(this);return false;" alt="Красные ворота" href="#" coords="364,231,440,241" shape="rect" />
            <area id="link_186" onclick="chSt(this);return false;" alt="Чистые пруды" href="#" coords="343,246,412,256" shape="rect" />

            <area id="link_85" onclick="chSt(this);return false;" alt="Лубянка" href="#" coords="278,277,327,287" shape="rect" />
            <area id="link_113" onclick="chSt(this);return false;" alt="Охотный ряд" href="#" coords="279,312,343,322" shape="rect" />
            <area id="link_22" onclick="chSt(this);return false;" alt="Библиотека имени Ленина" href="#" coords="227,365,330,375" shape="rect" />
            <area id="link_74" onclick="chSt(this);return false;" alt="Кропоткинская" href="#" coords="200,394,273,404" shape="rect" />
            <area id="link_116" onclick="chSt(this);return false;" alt="Парк культуры" href="#" coords="126,404,199,414" shape="rect" />
            <area id="link_179" onclick="chSt(this);return false;" alt="Фрунзенская" href="#" coords="21,563,87,573" shape="rect" />
            <area id="link_151" onclick="chSt(this);return false;" alt="Спортивная" href="#" coords="28,573,87,583" shape="rect" />
            <area id="link_43" onclick="chSt(this);return false;" alt="Воробьёвы горы" href="#" coords="9,583,87,593" shape="rect" />
            <area id="link_176" onclick="chSt(this);return false;" alt="Университет" href="#" coords="26,593,87,603" shape="rect" />

            <area id="link_133" onclick="chSt(this);return false;" alt="Проспект Вернадского" href="#" coords="7,603,87,613" shape="rect" />
            <area id="link_193" onclick="chSt(this);return false;" alt="Юго-Западная" href="#" coords="18,613,87,623" shape="rect" />
        <!-- /lINE_5-->

        <!-- lINE_6 -->
            <area id="link_190" onclick="chSt(this);return false;" alt="Щёлковская" href="#" coords="500,127,562,137" shape="rect" />
            <area id="link_119" onclick="chSt(this);return false;" alt="Первомайская" href="#" coords="500,137,571,147" shape="rect" />
            <area id="link_56" onclick="chSt(this);return false;" alt="Измайловская" href="#" coords="500,147,572,157" shape="rect" />
            <area id="link_118" onclick="chSt(this);return false;" alt="Партизанская" href="#" coords="500,157,569,167" shape="rect" />
            <area id="link_145" onclick="chSt(this);return false;" alt="Семёновская" href="#" coords="500,167,565,177" shape="rect" />

            <area id="link_192" onclick="chSt(this);return false;" alt="Электрозаводская" href="#" coords="500,177,590,187" shape="rect" />
            <area id="link_16" onclick="chSt(this);return false;" alt="Бауманская" href="#" coords="500,187,562,197" shape="rect" />
            <area id="link_80" onclick="chSt(this);return false;" alt="Курская" href="#" coords="411,273,460,283" shape="rect" />
            <area id="link_125" onclick="chSt(this);return false;" alt="Площадь Революции" href="#" coords="298,331,396,341" shape="rect" />
            <area id="link_11" onclick="chSt(this);return false;" alt="Арбатская" href="#" coords="173,377,229,387" shape="rect" />
            <area id="link_147" onclick="chSt(this);return false;" alt="Смоленская" href="#" coords="114,350,174,360" shape="rect" />
            <area id="link_62" onclick="chSt(this);return false;" alt="Киевская" href="#" coords="147,327,185,327,185,337,160,337,160,347,147,347" shape="poly" />
            <area id="link_117" onclick="chSt(this);return false;" alt="Парк Победы" href="#" coords="43,334,105,344" shape="rect" />
            <area id="link_1507" onclick="chSt(this);return false;" alt="Славянский бульвар" href="#" coords="3,290,63,300" shape="rect" />  
        <!-- /lINE_6-->

        <!-- lINE_7 -->
            <area id="link_" onclick="return false;" alt="Новокосино" coords="501,227,562,237" shape="rect" />
            <area id="link_102" onclick="chSt(this);return false;" alt="Новогиреево" href="#" coords="501,237,566,247" shape="rect" />
            <area id="link_120" onclick="chSt(this);return false;" alt="Перово" href="#" coords="501,247,539,257" shape="rect" />
            <area id="link_188" onclick="chSt(this);return false;" alt="Шоссе Энтузиастов" href="#" coords="501,257,588,267" shape="rect" />
            <area id="link_4" onclick="chSt(this);return false;" alt="Авиамоторная" href="#" coords="501,267,570,277" shape="rect" />
            <area id="link_124" onclick="chSt(this);return false;" alt="Площадь Ильича" href="#" coords="446,318,530,328" shape="rect" />
            <area id="link_88" onclick="chSt(this);return false;" alt="Марксистская" href="#" coords="407,353,480,363" shape="rect" />
        <!-- /lINE_7-->

        <!-- lINE_8 -->
            <area id="link_1581" onclick="chSt(this);return false;" alt="Митино" coords="9,145,50,155" href="#" shape="rect" />
            <area id="link_1583" onclick="chSt(this);return false;" alt="Волоколамская" coords="9,154,87,164" href="#" shape="rect" />
            <area id="link_1582" onclick="chSt(this);return false;" alt="Мякининская" coords="9,163,87,174" href="#" shape="rect" />
            <area id="link_154" onclick="chSt(this);return false;" alt="Строгино" href="#" coords="9,175,61,184" shape="rect" />
            <area id="link_75" onclick="chSt(this);return false;" alt="Крылатское" href="#" coords="9,185,67,195" shape="rect" />
            <area id="link_97" onclick="chSt(this);return false;" alt="Молодежная" href="#" coords="10,195,71,205" shape="rect" />
            <area id="link_78" onclick="chSt(this);return false;" alt="Кунцевская" href="#" coords="10,220,70,230" shape="rect" />

            <area id="link_123" onclick="chSt(this);return false;" alt="Пионерская" href="#" coords="24,235,81,245" shape="rect" />
            <area id="link_177" onclick="chSt(this);return false;" alt="Филёвский парк" href="#" coords="34,245,109,255" shape="rect" />
            <area id="link_14" onclick="chSt(this);return false;" alt="Багратионовская" href="#" coords="44,255,126,265" shape="rect" />
            <area id="link_178" onclick="chSt(this);return false;" alt="Фили" href="#" coords="54,265,269,275" shape="rect" />
            <area id="link_81" onclick="chSt(this);return false;" alt="Кутузовская" href="#" coords="64,275,277,285" shape="rect" />
            <area id="link_155" onclick="chSt(this);return false;" alt="Студенческая" href="#" coords="75,280,139,290" shape="rect" />
            <area id="link_94" onclick="chSt(this);return false;" alt="Международная" href="#" coords="122,296,198,306" shape="rect" />
            <area id="link_48" onclick="chSt(this);return false;" alt="Выставочная" href="#" coords="122,306,189,316" shape="rect" />
            <area id="link_1514" onclick="chSt(this);return false;" alt="Смоленская" coords="183,336,243,346" shape="rect" />

            <area id="link_1513" onclick="chSt(this);return false;" alt="Арбатская" coords="199,351,252,361" shape="rect" />
            <area id="link_7" onclick="chSt(this);return false;" alt="Александровский сад" href="#" coords="118,365,224,375" shape="rect" />
        <!-- /lINE_8-->

        <!-- lINE_9 -->
            <area id="link_36" onclick="chSt(this);return false;" alt="Варшавская" href="#" coords="305,495,365,505" shape="rect" />
            <area id="link_60" onclick="chSt(this);return false;" alt="Каховская" href="#" coords="292,550,351,560" shape="rect" />
        <!-- /lINE_9-->

        <!-- lINE_10 -->
            <area id="link_166" onclick="chSt(this);return false;" alt="Трубная" href="#" coords="287,199,333,209" shape="rect" />
            <area id="link_152" onclick="chSt(this);return false;" alt="Сретенский бульвар" href="#" coords="355,253,395,263" shape="rect" style="border: 1px solid red;" />
            <area id="link_187" onclick="chSt(this);return false;" alt="Чкаловская" href="#" coords="413,285,477,295" shape="rect" />
            <area id="link_139" onclick="chSt(this);return false;" alt="Римская" href="#" coords="446,331,497,341" shape="rect" />
            <area id="link_73" onclick="chSt(this);return false;" alt="Крестьянская застава" href="#" coords="446,395,548,405" shape="rect" />
            <area id="link_53" onclick="chSt(this);return false;" alt="Дубровка" href="#" coords="399,533,450,543" shape="rect" />
            <area id="link_64" onclick="chSt(this);return false;" alt="Кожуховская" href="#" coords="399,543,466,553" shape="rect" />
            <area id="link_122" onclick="chSt(this);return false;" alt="Печатники" href="#" coords="399,553,450,563" shape="rect" />
            <area id="link_42" onclick="chSt(this);return false;" alt="Волжская" href="#" coords="399,563,448,573" shape="rect" />
            <area id="link_87" onclick="chSt(this);return false;" alt="Люблино" href="#" coords="399,573,444,583" shape="rect" />

            <area id="link_31" onclick="chSt(this);return false;" alt="Братиславская" href="#" coords="399,583,472,593" shape="rect" />
            <area id="link_90" onclick="chSt(this);return false;" alt="Марьино" href="#" coords="399,593,444,603" shape="rect" />
        <!-- /lINE_10-->

        <!-- lINE_11-->
            <area id="link_107" onclick="chSt(this);return false;" alt="Новослободская" href="#" coords="181,182,267,192" shape="rect" />
            <area id="link_51" onclick="chSt(this);return false;" alt="Добрынинская" href="#" coords="280,444,355,454" shape="rect" />
            <area id="link_70" onclick="chSt(this);return false;" alt="Краснопресненская" href="#" coords="93,225,188,235" shape="rect" />
        <!-- /lINE_11-->*/?>

        <!-- to_ze_final-->
        <?php foreach( $metros["lines_dok"] as $key => $line_dok ) { ?>
            <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_<?=$line_dok->sid;?>" href="#" coords="<?=$line_dok->coords_map;?>" shape="<?=$line_dok->shape_map;?>" />
        <?php } ?> 
                                                        
        <?/* <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_planernaya" href="#" coords="81,1,95,15" shape="rect" />                                                        
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_rechnoy_vokzal" href="#" coords="180,1,195,15" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_altufevo" href="#" coords="255,1,270,15" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_medvedkovo" href="#" coords="380,1,395,15" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_podbelskogo" href="#" coords="480,1,495,15" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_szhelkovskaya" href="#" coords="499,111,514,126" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_novokosino" href="#" coords="499,210,514,225" shape="rect" />
                                                        
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_vihino" href="#" coords="480,634,495,649" shape="rect" />                                                         
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_marino" href="#" coords="397,604,412,619" shape="rect" />

             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_krasnogvardeyskaya" href="#" coords="380,634,395,649" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_bulvar_dm_donskogo" href="#" coords="292,657,307,672" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_bitzevskiy_park" href="#" coords="180,634,195,649" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_uygozapadnaya" href="#" coords="76,625,91,640" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_mezhdunarodnaya" href="#" coords="106,296,121,311" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" id="link_mezhdunarodnaya1" href="#" coords="20,210,30,220" shape="rect" />
             <area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" href="#" id="link_mitino" coords="7,128,22,143" shape="rect" />
             <!--area title="Выбор станций до кольцевой линии" alt="Выбор станций до кольцевой линии" onclick="chP(this); return false;" href="#" id="link_trubnaya" coords="288,184,303,199" shape="rect"/-->
        <!-- /to_ze_final-->*/?>

        <?php foreach( $metros["lines"] as $key => $line ) { ?>
             <?php    if ($line->groups=="L") { ?>                                                            
                 <area alt="<?=$line->title;?>" id="link_<?=$line->sid;?>" href="#" onclick="chL(this); return false;" coords="<?=$line->coords_map;?>" shape="<?=$line->shape_map;?>" />
             <?php    } else { ?>
                 <area alt="" href="#" coords="<?=$line->coords_map;?>" shape="<?=$line->shape_map;?>" />                                                                 
             <?php    } ?>
        <?php } ?>     
        <?/*<!-- select lINE_1-->                                                        
             <area alt="Таганско-Краснопресненская" id="link_tagansko-krasnopresnenskaya" href="#" onclick="chL(this); return false;" coords="83,135,96,149,216,269,303,269,482,449,481,630,491,631,490,445,306,260,220,260,92,131,93,17,84,16" shape="poly" />
             <area alt="Каховская" id="link_kahonovskaya" href="#" onclick="chL(this); return false;" coords="377,478,381,486,316,550,306,548" shape="poly" />
             <area alt="Калининская" id="link_kalininskaya" href="#" onclick="chL(this); return false;" coords="510,275,511,227,499,226,499,271,417,351,317,352,316,365,423,360" shape="poly" />
             <area alt="Люблинская" id="link_lyublinskaya" href="#" onclick="chL(this); return false;" coords="337,265,362,265,391,297,418,297,448,327,449,485,399,533,399,601,409,601,409,536,457,491,459,324,423,287,394,287,366,256,344,259,298,214,287,215" shape="poly" />
             <area alt="Арбатско-Покровская" id="link_arbatsko-pokrovskaya" href="#" onclick="chL(this); return false;" coords="100,346,152,345,190,388,260,388,303,344,362,342,508,196,509,127,498,128,498,191,355,335,297,335,257,376,196,379,152,335,103,336,17,245,17,143,9,143,9,253" shape="poly" />
             <area alt="Филевская" id="link_filevskaya" href="#" onclick="chL(this); return false;" coords="10,227,123,340,188,345,209,367,218,363,190,336,158,336,137,316,125,317,141,333,130,333,18,222,18,183,9,183" shape="poly" />
             <area alt="Замоскворецкая" id="link_zamoskvoretskaya" href="#" onclick="chL(this); return false;" coords="185,168,221,205,222,264,382,419,382,632,391,632,390,415,231,257,232,199,193,163,192,15,182,18" shape="poly" />
             <area alt="Сокольническая" id="link_sokolnicheskaya" href="#" onclick="chL(this); return false;" coords="490,14,481,16,482,113,79,517,79,623,89,621,89,521,492,117" shape="poly" />

             <area alt="Калужская" id="link_kaluzhsko-rizhskaya" href="#" onclick="chL(this); return false;" coords="383,155,345,194,346,324,184,489,184,632,194,631,194,493,355,334,356,197,392,160,390,17,382,17" shape="poly" />
             <area alt="Серпуховско-Тимирязевская" id="link_serpuhovsko-timiryazevskaya" href="#" onclick="chL(this); return false;" coords="258,103,257,178,285,205,228,262,228,381,283,434,283,660,292,661,291,429,237,377,237,266,297,205,266,171,265,14,255,16" shape="poly" />
             <area alt="Л1 - Бутовская" id="link_butovskaya" href="#" onclick="chL(this); return false;" coords="291,671,290,728,280,729,281,671" shape="poly" />
             <area alt="" shape="circle" coords="288,317,130" href="#" />
             <area alt="Кольцевая" id="link_koltsevaya" shape="circle" coords="288,317,138" href="#" onclick="chL(this); return false;" />
        <!-- /select lINE_1-->*/?>
        </map>

        <!-- marker_chose_stations -->                                                    
        <?php foreach( $metros["stations"] as $key => $station ) { ?>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_<?=$station->mapid;?>" style="<?=$station->style_pointer_map;?>"></div>                                                      
        <?php } ?>                                                         
        <?/*
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_176" style="top: 596px; left: 82px;"></div>                                                      
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_44" style="top: 626px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_140" style="top: 616px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_77" style="top: 606px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_161" style="top: 596px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_41" style="top: 586px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_90" style="top: 596px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_31" style="top: 586px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_87" style="top: 576px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_42" style="top: 566px; left: 402px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_122" style="top: 556px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_64" style="top: 546px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_53" style="top: 536px; left: 402px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_58" style="top: 586px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_181" style="top: 596px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_111" style="top: 606px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_52" style="top: 616px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_32" style="top: 723px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_172" style="top: 713px; left: 285px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_28" style="top: 703px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_174" style="top: 693px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_69" style="top: 626px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_175" style="top: 677px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_29" style="top: 665px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_10" style="top: 626px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_171" style="top: 616px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_129" style="top: 606px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_194" style="top: 596px; left: 285px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_184" style="top: 586px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_167" style="top: 509px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_60" style="top: 555px; left: 297px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_143" style="top: 555px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_100" style="top: 539px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_99" style="top: 529px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_98" style="top: 519px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1581" style="top: 148px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1583" style="top: 158px; left: 12px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1582" style="top: 168px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_154" style="top: 178px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_75" style="top: 188px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_97" style="top: 198px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_78" style="top: 223px; left: 12px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_123" style="top: 238px; left: 27px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_177" style="top: 248px; left: 37px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_14" style="top: 258px; left: 47px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_178" style="top: 268px; left: 57px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_81" style="top: 278px; left: 67px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_155" style="top: 288px; left: 77px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1507" style="top: 294px; left: 58px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_117" style="top: 337px; left: 100px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_152" style="top: 258px; left: 358px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_186" style="top: 252px; left: 348px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_131" style="top: 412px; left: 451px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_73" style="top: 400px; left: 451px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_36" style="top: 498px; left: 360px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_61" style="top: 474px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_65" style="top: 462px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_5" style="top: 452px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_115" style="top: 412px; left: 379px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_146" style="top: 460px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_94" style="top: 299px; left: 123px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_48" style="top: 309px; left: 123px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_51" style="top: 448px; left: 285px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_128" style="top: 430px; left: 285px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_116" style="top: 410px; left: 191px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_74" style="top: 397px; left: 204px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_26" style="top: 380px; left: 236px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_22" style="top: 370px; left: 230px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_7" style="top: 370px; left: 218px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1513" style="top: 354px; left: 202px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_11" style="top: 380px; left: 224px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_1514" style="top: 339px; left: 187px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_147" style="top: 353px; left: 168px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_62" style="top: 338px; left: 153px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_158" style="top: 370px; left: 409px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_88" style="top: 358px; left: 413px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_104" style="top: 360px; left: 328px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_125" style="top: 335px; left: 302px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_160" style="top: 326px; left: 293px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_113" style="top: 317px; left: 284px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_185" style="top: 264px; left: 230px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_135" style="top: 264px; left: 218px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_159" style="top: 254px; left: 224px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_85" style="top: 281px; left: 320px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_76" style="top: 273px; left: 312px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_139" style="top: 335px; left: 451px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_124" style="top: 323px; left: 451px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_187" style="top: 290px; left: 418px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_80" style="top: 278px; left: 416px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_4" style="top: 270px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_188" style="top: 260px; left: 504px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_120" style="top: 250px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_102" style="top: 240px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_n_novokosino" style="top: 230px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_70" style="top: 229px; left: 182px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_92" style="top: 226px; left: 224px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_72" style="top: 234px; left: 367px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_66" style="top: 220px; left: 381px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_166" style="top: 204px; left: 292px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_182" style="top: 204px; left: 280px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_16" style="top: 190px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_192" style="top: 180px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_145" style="top: 170px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_118" style="top: 160px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_56" style="top: 150px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_119" style="top: 140px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_190" style="top: 130px; left: 504px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_71" style="top: 61px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_149" style="top: 51px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_130" style="top: 41px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_183" style="top: 31px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_173" style="top: 21px; left: 485px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_18" style="top: 200px; left: 220px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_107" style="top: 185px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_95" style="top: 173px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_141" style="top: 150px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_50" style="top: 140px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_163" style="top: 130px; left: 260px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_121" style="top: 91px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_38" style="top: 51px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_112" style="top: 41px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_21" style="top: 31px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_9" style="top: 21px; left: 260px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_49" style="top: 71px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_12" style="top: 61px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_148" style="top: 51px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_40" style="top: 41px; left: 186px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_39" style="top: 31px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_179" style="top: 566px; left: 82px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_151" style="top: 576px; left: 82px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_137" style="top: 21px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_15" style="top: 221px; left: 174px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_170" style="top: 91px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_17" style="top: 81px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_127" style="top: 71px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_110" style="top: 61px; left: 86px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_191" style="top: 51px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_169" style="top: 41px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_157" style="top: 31px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_126" style="top: 21px; left: 86px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_133" style="top: 606px; left: 82px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_193" style="top: 616px; left: 82px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_43" style="top: 586px; left: 82px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_93" style="top: 21px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_13" style="top: 31px; left: 385px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_142" style="top: 41px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_27" style="top: 51px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_37" style="top: 61px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_8" style="top: 71px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_138" style="top: 82px; left: 385px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_134" style="top: 195px; left: 348px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_164" style="top: 360px; left: 317px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_156" style="top: 226px; left: 348px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_109" style="top: 440px; left: 236px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_168" style="top: 264px; left: 348px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_63" style="top: 310px; left: 349px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_189" style="top: 526px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_83" style="top: 536px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_6" style="top: 546px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_132" style="top: 556px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_108" style="top: 566px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_57" style="top: 576px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_19" style="top: 586px; left: 186px;"></div>

             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_67" style="top: 596px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_162" style="top: 606px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_196" style="top: 616px; left: 186px;"></div>
             <div class="marker_chose_station" onclick="chSt(this);return false;" id="pointer_25" style="top: 626px; left: 186px;"></div>
         */?>

         <!-- /marker_chose_stations --> 
             <div class="choice_station"></div>                                         
          </div>
        </td>
        <td class="text_map" style="padding-right: 10px;padding-top:0px; text-align: right">  
           <div class="ul_regions">
              <b>Округа и районы</b>
              <div style="overflow: auto; /*height: 220px;*/padding-bottom: 10px;">
                 <ul>
                     <?php $beg = true; ?>    
                     <?php foreach( $metros["saos"] as $key => $sao ) { ?>                                                            
                         <li id="mapMenu_<?=$sao->sid;?>" <?=($beg ? 'class="first"' : '');?>>                                                         
                         <?php if ($beg) {
                                   $beg = false;
                               } 
                         ?>    
                         <? if (array_key_exists($sao->sid,$metros["childs"])) { ?>
                              <span class="plus-minus" onclick="chPM(this)">  </span>
                         <? } ?>
                              <div><a id="link_<?=$sao->sid;?>" href="#" onclick="chR(this); return false"><?=$sao->title;?></a></div>
                         <? if (array_key_exists($sao->sid,$metros["childs"])) { ?>
                              <ul>
                              <? foreach( $metros["childs"][$sao->sid] as $sey => $child) { ?>
                                 <li><a href="#" id="link_<?=$child->sid;?>" onclick="chO(this); return false"><?=$child->title;?></a></li>
                              <?     } ?>
                              </ul>    
                         <? } ?>
                         </li>                
                     <?php } ?>  
                     <?/*<li id="mapMenu_202" class="first"> 
                            <div><a id="link_202" href="#" onclick="chR(this); return false">Центральный А.О.</a></div>
                         </li>
                         <li id="mapMenu_199">
                            <span class="plus-minus" onclick="chPM(this)">  </span>
                            <div><a id="link_199" href="#" onclick="chR(this); return false">Северный А.О.</a></div> 
                            <ul>
                              <li><a href="#" id="link_20" onclick="chO(this); return false">Бескудниково</a></li>
                              <li><a href="#" id="link_33" onclick="chO(this); return false">Бусиново</a></li>
                              <li><a id="link_46" href="#" onclick="chO(this); return false">Дегунино Вост.</a></li>
                              <li><a id="link_47" href="#" onclick="chO(this); return false">Дегунино Зап.</a></li>
                              <li><a id="link_180" href="#" onclick="chO(this); return false">Ховрино</a></li> 
                            </ul>
                         </li>
                         <li id="mapMenu_200">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_200" href="#" onclick="chR(this); return false">Северо-Восточный А.О.</a></div>
                            <ul>
                               <li><a id="link_84" href="#" onclick="chO(this); return false">Лианозово</a></li>
                               <li><a id="link_144" href="#" onclick="chO(this); return false">Северный пос.</a></li> 
                            </ul>
                         </li>
                         <li id="mapMenu_197">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_197" href="#" onclick="chR(this); return false">Восточный А.О.</a></div>
                            <ul>
                               <li><a id="link_45" href="#" onclick="chO(this); return false">Гольяново</a></li>
                               <li><a id="link_68" href="#" onclick="chO(this); return false">Косино</a></li>  
                               <li><a id="link_103" href="#" onclick="chO(this); return false">Новокосино</a></li>
                               <li><a id="link_195" href="#" onclick="chO(this); return false">Южное Измайлово</a></li>
                            </ul>
                         </li>
                         <li id="mapMenu_204">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_204" href="#" onclick="chR(this); return false">Юго-Восточный А.О.</a></div>
                            <ul>  
                               <li><a id="link_54" href="#" onclick="chO(this); return false">Жулебино</a></li>
                               <li><a id="link_59" href="#" onclick="chO(this); return false">Капотня</a></li>
                               <li><a id="link_86" href="#" onclick="chO(this); return false">Люблино</a></li>
                               <li><a id="link_89" href="#" onclick="chO(this); return false">Марьино</a></li>
                            </ul>
                         </li>
                         <li id="mapMenu_203">
                            <span class="plus-minus" onclick="chPM(this)"> </span> 
                            <div><a id="link_203" href="#" onclick="chR(this); return false">Южный А.О.</a></div>
                            <ul>
                               <li><a id="link_23" href="#" onclick="chO(this); return false">Бирюлево Вост.</a></li>
                               <li><a id="link_24" href="#" onclick="chO(this); return false">Бирюлево Зап.</a></li>
                               <li><a id="link_30" href="#" onclick="chO(this); return false">Братеево</a></li>
                            </ul>
                         </li> 
                         <li id="mapMenu_205">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_205" href="#" onclick="chR(this); return false">Юго-Западный А.О.</a></div>
                            <ul>
                               <li><a id="link_34" href="#" onclick="chO(this); return false">Бутово Сев.</a></li>
                               <li><a id="link_35" href="#" onclick="chO(this); return false">Бутово Южн.</a></li>
                            </ul>
                         </li>  
                         <li id="mapMenu_198">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_198" href="#" onclick="chR(this); return false">Западный А.О.</a></div>
                            <ul>
                               <li><a id="link_91" href="#" onclick="chO(this); return false">Матвеевское</a></li>
                               <li><a id="link_101" href="#" onclick="chO(this); return false">Никулино</a></li>
                               <li><a id="link_105" href="#" onclick="chO(this); return false">Новопеределкино</a></li>  
                               <li><a id="link_114" href="#" onclick="chO(this); return false">Очаково</a></li>
                               <li><a id="link_136" href="#" onclick="chO(this); return false">Раменки</a></li>
                               <li><a id="link_150" href="#" onclick="chO(this); return false">Солнцево</a></li>
                               <li><a id="link_165" href="#" onclick="chO(this); return false">Тропарево</a></li>
                            </ul>
                         </li>
                         <li id="mapMenu_201">
                            <span class="plus-minus" onclick="chPM(this)"> </span>  
                            <div><a id="link_201" href="#" onclick="chR(this); return false">Северо-Западный А.О.</a></div>
                            <ul>
                               <li><a id="link_79" href="#" onclick="chO(this); return false">Куркино</a></li>
                               <li><a id="link_96" href="#" onclick="chO(this); return false">Митино</a></li>
                               <li><a id="link_153" href="#" onclick="chO(this); return false">Строгино</a></li>
                            </ul>
                         </li>  
                         <li id="mapMenu_n_zelenograd">
                            <span class="plus-minus" onclick="chPM(this)"> </span>
                            <div><a id="link_n_zelenograd" href="#" onclick="chR(this); return false">Зеленоград А.О.</a></div>
                            <ul>
                               <li><a id="link_55" href="#" onclick="chO(this); return false">Зеленоград</a></li>
                            </ul>
                         </li>
                         <li id="mapMenu_n_himki">
                            <span class="plus-minus" onclick="chPM(this)"> </span> 
                            <div><a id="link_n_himki" href="#" onclick="chR(this); return false">Район г. Химки (МО)</a></div>
                            <ul>
                               <li><a id="link_106" href="#" onclick="chO(this); return false">Новоподрезково</a></li>
                            </ul>
                         </li>
                      */?>                                                         
                    </ul>
                </div>
             </div>  
             <div class="ul_regions ul_line" style="padding-bottom: 10px;">
               <b>Линии метро</b>
               <div class="rows">
                   <ul class="ul1">
                   <?php foreach( $metros["slines"] as $key => $sline ) { ?>
                        <li id="line<?=$sline->linesort;?>"><span>M</span><a href="#" id="slink_<?=$sline->sid;?>" onclick="chL(this); return false;"><?=$sline->title;?></a></li>                                                            
                   <?php } ?> 
                   <?/* <li id="line1"><span>M</span><a href="#" id="slink_koltsevaya" onclick="chL(this); return false;">Кольцевая</a></li>
                        <li id="line2"><span>M</span><a href="#" id="slink_filevskaya" onclick="chL(this); return false;">Филевская</a></li>
                        <li id="line3"><span>M</span><a href="#" id="slink_arbatsko-pokrovskaya" onclick="chL(this); return false;">Арбатско-Покровская</a></li>
                        <li id="line4"><span>M</span><a href="#" id="slink_sokolnicheskaya" onclick="chL(this); return false;">Сокольническая</a></li>
                        <li id="line5"><span>M</span><a href="#" id="slink_kaluzhsko-rizhskaya" onclick="chL(this); return false;">Калужско-Рижская</a></li>
                        <li id="line6"><span>M</span><a href="#" id="slink_serpuhovsko-timiryazevskaya" onclick="chL(this); return false;"><nobr>Серпуховско-</nobr> Тимирязевская</a></li> 
                        <li id="line7"><span>M</span><a href="#" id="slink_kahonovskaya" onclick="chL(this); return false;">Каховская</a></li>
                        <li id="line8"><span>M</span><a href="#" id="slink_zamoskvoretskaya" onclick="chL(this); return false;">Замоскворецкая</a></li>
                        <li id="line9"><span>M</span><a href="#" id="slink_lyublinskaya" onclick="chL(this); return false;">Люблинская</a></li>
                        <li id="line10"><span>M</span><a href="#" id="slink_tagansko-krasnopresnenskaya" onclick="chL(this); return false;"><nobr>Таганско-</nobr> Краснопресненская</a></li> 
                        <li id="line11"><span>M</span><a href="#" id="slink_kalininskaya" onclick="chL(this); return false;">Калининская</a></li>
                        <li id="line12"><span>M</span><a href="#" id="slink_butovskaya" onclick="chL(this); return false;"><nobr>Л1-Бутовская</nobr></a></li>                                                          
                   */?>
                   </ul>
               </div>
            </div>                    
            <div class="ul_regions ul_line" style="padding-bottom: 10px;" >  
               <b>Группы станций</b>
               <div class="rows">
                   <ul class="ul1">
                   <?php foreach( $metros["gstations"] as $gey => $gstation ) { ?>
                         <li id="line<?=$gstation->sid;?>"><span>M</span><a href="#" id="slink_<?=$gstation->sid;?>" onclick="chL(this); return false;"><nobr><?=$gstation->title;?></nobr></a></li>
                   <?php } ?>                                                       
                   <?/*<li id="linecenter"><span>M</span><a href="#" id="slink_center" onclick="chL(this); return false;"><nobr>Внутри СК</nobr></a></li>
                       <li id="linecenterplus"><span>M</span><a href="#" id="slink_centerplus" onclick="chL(this); return false;"><nobr>Внутри ТТК</nobr></a></li>*/?>
                   </ul>
               </div>
            </div>
            <div class="ul_regions ul_line">
                <div class="rows">
                    <div id="check_okrug" style="overflow: auto; height: 50px;">
                        <div class="whitezap"> </div>
                            <b>Выбранные Округа</b> 
                            <div id="districts_text"></div>
                    </div>
                </div>
                <div class="rows">
                    <div id="check_stancii" style="overflow: auto; height: 60px;">
                        <div class="whitezap"> </div>
                            <b>Выбранные станции метро</b>
                            <div id="stantions_text"></div>  
                        </div>
                    </div>
                <div class="rows" style="margin-top: 5px;">
                    <div class="buttons">
                        <input onclick="metroMap.reset(); return false;" value="Очистить" style="width: 80px;" type="reset" />
                        <input value="Готово" style="width: 80px;" type="button" class="toggleMap" />
                    </div>
                </div>
            </div>
        </td>  
      </tr>  
   </tbody>
</table>