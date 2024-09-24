PGDMP      /                |            postgres    16.4    16.4 1    	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    5    postgres    DATABASE     �   CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE postgres;
                postgres    false                       0    0    DATABASE postgres    COMMENT     N   COMMENT ON DATABASE postgres IS 'default administrative connection database';
                   postgres    false    4876                        3079    16384 	   adminpack 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;
    DROP EXTENSION adminpack;
                   false                       0    0    EXTENSION adminpack    COMMENT     M   COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';
                        false    2            �            1259    16394    ayuttaya    TABLE     �  CREATE TABLE public.ayuttaya (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.ayuttaya;
       public         heap    postgres    false            �            1259    16399 	   cotraboon    TABLE     �  CREATE TABLE public.cotraboon (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    "Birth" integer,
    "Death" integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer
);
    DROP TABLE public.cotraboon;
       public         heap    postgres    false            �            1259    16404    funan    TABLE     �  CREATE TABLE public.funan (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.funan;
       public         heap    postgres    false            �            1259    16409 
   hripunchai    TABLE     �  CREATE TABLE public.hripunchai (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.hripunchai;
       public         heap    postgres    false            �            1259    16414    janela    TABLE     �  CREATE TABLE public.janela (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.janela;
       public         heap    postgres    false            �            1259    16419 
   kamenravak    TABLE     �  CREATE TABLE public.kamenravak (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.kamenravak;
       public         heap    postgres    false            �            1259    16424    lanchang    TABLE     �  CREATE TABLE public.lanchang (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.lanchang;
       public         heap    postgres    false            �            1259    16429    lanna    TABLE     �  CREATE TABLE public.lanna (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.lanna;
       public         heap    postgres    false            �            1259    16434    lavo    TABLE     �  CREATE TABLE public.lavo (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender text
);
    DROP TABLE public.lavo;
       public         heap    postgres    false            �            1259    16439    panakorn    TABLE     �  CREATE TABLE public.panakorn (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.panakorn;
       public         heap    postgres    false            �            1259    16444    ratanakosin    TABLE     �  CREATE TABLE public.ratanakosin (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.ratanakosin;
       public         heap    postgres    false            �            1259    16449 	   srivichai    TABLE     �  CREATE TABLE public.srivichai (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.srivichai;
       public         heap    postgres    false            �            1259    16454    sukothai    TABLE     �  CREATE TABLE public.sukothai (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.sukothai;
       public         heap    postgres    false            �            1259    16459    tampornling    TABLE     �  CREATE TABLE public.tampornling (
    id integer NOT NULL,
    name character varying,
    reignstart integer,
    reignend integer,
    before character varying,
    after character varying,
    birth integer,
    death integer,
    monarch character varying,
    wife character varying,
    child character varying,
    father character varying,
    mother character varying,
    urlking character varying,
    latitude double precision,
    longitude double precision,
    kingdomname character varying,
    url character varying,
    imgplace character varying,
    relationship character varying,
    parent_id integer,
    tags text,
    img character varying,
    ppid integer,
    gender character varying(10)
);
    DROP TABLE public.tampornling;
       public         heap    postgres    false            �          0    16394    ayuttaya 
   TABLE DATA           �   COPY public.ayuttaya (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    216   `[       �          0    16399 	   cotraboon 
   TABLE DATA           �   COPY public.cotraboon (id, name, reignstart, reignend, before, after, "Birth", "Death", monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid) FROM stdin;
    public          postgres    false    217   �v       �          0    16404    funan 
   TABLE DATA           �   COPY public.funan (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    218   �v       �          0    16409 
   hripunchai 
   TABLE DATA           �   COPY public.hripunchai (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    219   �}       �          0    16414    janela 
   TABLE DATA           �   COPY public.janela (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    220   ��       �          0    16419 
   kamenravak 
   TABLE DATA           �   COPY public.kamenravak (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    221   Ȏ       �          0    16424    lanchang 
   TABLE DATA           �   COPY public.lanchang (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    222   ��                  0    16429    lanna 
   TABLE DATA           �   COPY public.lanna (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    223   P�                 0    16434    lavo 
   TABLE DATA           �   COPY public.lavo (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    224   +�                 0    16439    panakorn 
   TABLE DATA           �   COPY public.panakorn (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    225   ��                 0    16444    ratanakosin 
   TABLE DATA           �   COPY public.ratanakosin (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    226   M�                 0    16449 	   srivichai 
   TABLE DATA           �   COPY public.srivichai (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    227   ��                 0    16454    sukothai 
   TABLE DATA           �   COPY public.sukothai (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    228   :�                 0    16459    tampornling 
   TABLE DATA           �   COPY public.tampornling (id, name, reignstart, reignend, before, after, birth, death, monarch, wife, child, father, mother, urlking, latitude, longitude, kingdomname, url, imgplace, relationship, parent_id, tags, img, ppid, gender) FROM stdin;
    public          postgres    false    229   |�       O           2606    16466    ayuttaya Ayuttaya_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.ayuttaya
    ADD CONSTRAINT "Ayuttaya_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.ayuttaya DROP CONSTRAINT "Ayuttaya_pkey";
       public            postgres    false    216            Q           2606    16468    cotraboon CotraBoon_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.cotraboon
    ADD CONSTRAINT "CotraBoon_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.cotraboon DROP CONSTRAINT "CotraBoon_pkey";
       public            postgres    false    217            S           2606    16470    funan Funan_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.funan
    ADD CONSTRAINT "Funan_pkey" PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.funan DROP CONSTRAINT "Funan_pkey";
       public            postgres    false    218            U           2606    16472    hripunchai Hripunchai_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.hripunchai
    ADD CONSTRAINT "Hripunchai_pkey" PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.hripunchai DROP CONSTRAINT "Hripunchai_pkey";
       public            postgres    false    219            W           2606    16474    janela Janela_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.janela
    ADD CONSTRAINT "Janela_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.janela DROP CONSTRAINT "Janela_pkey";
       public            postgres    false    220            Y           2606    16476    kamenravak Kamenravak_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.kamenravak
    ADD CONSTRAINT "Kamenravak_pkey" PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.kamenravak DROP CONSTRAINT "Kamenravak_pkey";
       public            postgres    false    221            [           2606    16478    lanchang Lanchang_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.lanchang
    ADD CONSTRAINT "Lanchang_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.lanchang DROP CONSTRAINT "Lanchang_pkey";
       public            postgres    false    222            ]           2606    16480    lanna Lanna_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.lanna
    ADD CONSTRAINT "Lanna_pkey" PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.lanna DROP CONSTRAINT "Lanna_pkey";
       public            postgres    false    223            _           2606    16482    lavo Lavo_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.lavo
    ADD CONSTRAINT "Lavo_pkey" PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.lavo DROP CONSTRAINT "Lavo_pkey";
       public            postgres    false    224            a           2606    16484    panakorn Panakorn_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.panakorn
    ADD CONSTRAINT "Panakorn_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.panakorn DROP CONSTRAINT "Panakorn_pkey";
       public            postgres    false    225            c           2606    16486    ratanakosin Ratanakosin_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.ratanakosin
    ADD CONSTRAINT "Ratanakosin_pkey" PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.ratanakosin DROP CONSTRAINT "Ratanakosin_pkey";
       public            postgres    false    226            e           2606    16488    srivichai Srivichai_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.srivichai
    ADD CONSTRAINT "Srivichai_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.srivichai DROP CONSTRAINT "Srivichai_pkey";
       public            postgres    false    227            g           2606    16490    sukothai Sukothai_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.sukothai
    ADD CONSTRAINT "Sukothai_pkey" PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.sukothai DROP CONSTRAINT "Sukothai_pkey";
       public            postgres    false    228            i           2606    16492    tampornling Tampornling_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tampornling
    ADD CONSTRAINT "Tampornling_pkey" PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.tampornling DROP CONSTRAINT "Tampornling_pkey";
       public            postgres    false    229            �      x��]oo�ƙ�|
�1`gq9$�d�I�[\�A�áh�mK�jK+�+8Aq��3 E��=Ċ#P"��
��u����,�Inf�9Ù!�Ҭ$�z�%���=��q���h4��>_�N7F���pw4<��_������h�
�6|?�D���S�儑k9�����w�w���[�	�~7��v5�E?���N����)�~߰�H[?�v�O�bjt�_��cI&{��M2����̵u|N�o��_�0�_�����G:�bV�^��u���?��YV�¶�O.���_����l�?���ε�������/ѵ��^�<r%H��!��6y�M��v�+ �2s%"��z��L�S��O��+p<aҐ7�zA����L�ݎ�w�2����G�!^f��XsunqC�Ge��3t�kAۙ!O͆ŵ�~tpk+���}<��� �p�{�����c8����vlǀ<(�.��݅�O�-dt�濰CZ���-rχ�N�q��t�����I����ފ똚ް�ן��Gs�V�UEvt���(*R�F����9:z��1���-�q}Q���+�FzO��K�pM> ����t�O���c��� �i�!w	sCw�+�7�Ү��İ �A��-��u��-��t Š�h?X��������̗��4^�{�/�Ri	A$$ʉ�E���&^�c�ox��:� �c:���~��"��D���^��y��c?���Q8��C�j8N�Kǒ�Z�E�	CR���'O�L�,.�{����ᛱW��_\��.�Iw���y�^|�^myp��x��������͵�s�7�ߖ!��\Y~��L�/O�q���>�aru�E��x�2��Z�)$"��\!��푨������g����oP��1@U�I�B�jح���%F���J��-��7�N�Σ�ϣ�7x�' �AW"`U����F�}��W�4���O�s��7~�{� pu�)����:��xxŖɫ�L�v�����Z���1~'�;��؋��Iw"aCK��ݰ��RI��R#U+B�"�1·�!�*��*P��+Z����y�`:�����ޒ/�L���6�_qWś����7z��FwA�w��0���$�pט�Kn����]dl�v�l�
)Ă��3���D�v��y*$� �ӗX�|���Clf�y�d*ֻX�=�]���Ը�魽����[ 7�����:M:l�-�����Vh�!壘��[4}�ٵ��	p�݀>���̓�f�c)�-F�m�C+���l/����wg5^|��pwn����c\�;A1�y�# ��訇��5����� �����q
�g�y�
�-�C�cE�$VUJUP
tr/��Zx���?B`�����v�����gxu�^�-ܚ�[�rLy�y4�
� ���ۮfK}x������(���ޚ��&A&�PA��<U-[@l� B�ǔ�ˑ�wk"P ?B����4����~H\L�30=jy�r�9p�'$��0���*)Ցl�$^�g<�C�u��M�|�����~�C>��)cޤ�Lq�9Ѵ�ĺ�kN�DBZ�U�� X�\ td��`l��0[� � ����aa��3V}HX�F|��NǑ��F�S2$�s�_2��%i0�l�e�؂gAQ�^����}7�}���c��P;��.8� R�_9(�޽��{(j�@`%�n�9Ƭ������6�EL����}�e�6
8K��R�#�lT�ތ�(�EZm���&h���v0��#ֱF���'8�k�b���X\-(C�8N���@U�m/$��Z$���#��>nNj�������h�X=Ŀ$cyIn,����,r�Q[��
W`O��vu�b4��r}Ƃ=�s8�����7[�����h�E��k��A��7��S�u`!:�P��\I����3�#�fTc�������&@����b{���)Ю�p��g����\�4[���*B�4`Y���~@�ef���3�!�gB���x�%����7	$(Dx����o	1�$��wfK��˺���20������yP��<X����y���Bܻ�/-ū�����|a�P�����4��@0�:_����,T��� +���٦V(���ʊ9%wV*��ʞOq+<�H�{m��)���Ž�t�Se4�S>6��syܹ@�C�ç���kԓC�pNЉBf$2�a3����l��/F�E+q<H[��]�Z������N�؂�j���Z)a��aR�l�������~h �a����Bi� s��B�����l��q��p�Ֆ�!/9$������\�R��J��,�d@|U��l*\�ɤ��=sj�9�-*D�>*Gv�ٷƃ��q��<Y���;�<D+@V$}��C+D`?��L�"|�P���bu�w�U^F� 2e�*�^%�u�?�P}椾[|4���)_/�vJ� � n'P�,4X5���L_�?����n�ƙ9쒀��Xd�6O4�E;&v�m$�Jc�
h?�M8�W=Z�<N��:;Z�n��~;��|W���'!�����Ὂ,S.('�K��i�R`���gPS�UN�I�ݽ��2�޼����N:m}�-ޙ���FC�"�Q�G���堪�VT;"C"� ��q��'� ,N@)}ޏ�W ��b�P���Xg�\�XW��`ЋA�U5T�ǈ$f#���|hb���� �<g��0(�\g|mih����Y�ݩ)�x�~L�:��Ko��_ަc�;���#
5�Y�qP񢓁[�n��|{�R2���=����`5^���=���?��;P]���1p-��R�$�H%8k"��6�s���H4��p���*m�� P��4�AI��Z03fpk�:!(�G]x���)���P�nF3>4�L��k怴��B�9H뚃4W���*Ҁ��#=|T�T������3���ue�d�ɰe%��8��=�펾a��qRC�����.����HoA�b��|��p!����Z�FDr.%�ʡ�S�t��.�4M�	ۄ���L�8��%��w5o���j�ӿ��W�PT��t� x
��9�Ŀ���S)\�U��Iՠ��^�u�½sC���Lͽu<_^���{��J��}�<�:�L��4j�X�����<��w�^-�Oej��JRT�>���������ܷ��3S���ci��yOϭ2��bReE��m��5ms���'�����8��3�ܺ�����'�|���3�;���]�ӹ/z�-�K��_�~?��]o��6ă�Ӎ:x0]'�ꜻz\18 �,���} :�X���u����Ƨ��BFJ�c|�i��([�]WG�h*c/��ר��{�u�B&}��5�oH����d�`��`�C-[���5s|-��>V���vxW�
��Q�t7���a�0�.��#+{ӌ��A�\��rY��#=:PG���ep�����N�(���O	Uckl���v�"�/Z�9�C}�������������Vyk��b}UmUv�kb��KU��R�2]�JZl����$8��"�:%��zU�Se��3����l ^�4d��ZOf��Oa!DM(q��{+���1�j�n�3���u��lq�d��<������/	�DD���<����{7d�K{�@�D�@��8*�5�2sd w;
?��(SexC��{�d���$��`�\ s"Zl%��e���	�=�X�.�~N����㴌����K��4�s�������K�f3g{8ly[����6�>o6����j�a�{z��`5�99n��!&4��z	�BxIϷ7r1��	�և�,A^Q��aȆHzr��e%��G�N��oxjG$��H��[1sx�a=9M����j4����zЌ 6�����qB��q0�X"Hl��S��9�Mf��p䂱*�n�PDA҉R^�!�U�xrK��.��O�Q{ �4׍t,7b�`]��4���ࣻ���� �d<=(^�;��aZƜ,�K�|W�-��������ޭ9 P  ���2J7��{3_��1�=�k��X���0�qG+���'�sH����AT\�����@" #�`}gO><�W��q�Dm�>"#N��fbL�6i�Q5,���'�R��m!����N���(�Յ��?+�aWf���š�`��M�j�~��A4+O#�o�'(j�44�-��rg��٭ϝ]��<��cȉ��/��g��5�[���G9;t`!*3����(���K�3N�������"�DP����ux��7��gK��~�kX�}lT���p���P8ˎd�����	��IC7���D]Z^;}��ơ���f6.�P/�p=L���L�xﺆ�A��*cs�P��s�~�[}�i{����E�%@S]�[�'c�@��_�,���SN'h`�Ѽ'V0��5|��l�/��ЊҌ���J�.k���mJz�[ܔ��a��������n	��V8YF��=��t�?�k���������mY��~2��Ѯ�p��$o ]�zt��`T��
�ӛ�}�lV��WΘ�1skߟ��>�<���@��ȹD�L�� 2�ɧt�(��r��M�r�c�c��"�7�x��jn��,�u��X�ŠJVH	�7��E)�ﰔ��Q7��
�/G�\@�sҽtL���к���"���tą�K�.��ܑ���[>0�u�s���U�Qg%wV���x�L��E��"9�鳠A ��|E
մ�w��o���/?��!xj�^�݉�@��?X�}@i�[���r&��Iyz��1K�J��YΖ�����Uc̚���c�->R�|q%�y&�&*��Z�s[�Q�MokT�|�Dy��=�!���%j�p[Hp&ns�i:2�[t	J�($ңAL*N�F@�l��U��f�qT� 5N!@#ޝ��^��]X�};�b�;.�\�x��2\r	T�:}`�����Jw�{ ����˘���j��Z�����>��X�[����%���]�h4���T������p�Joܠ0s�p�r��2"�P�n�b�g���|����e���� G��68{������ԍyg�j�A
������M[��/+~X�3 �N��X�ʅfӠ����t�gq
�TO�ҋA��ԕ�aڢ���KЩ[_�O��:��߾w^8g����㽔��_�l��2�N9`hT���:!B�^��Ei�����Iu���G�ץu��ir�BC�R�A�i��5�Ɩ�C>
�����<��b���A
��\/AL�Y�#Qa���j���*z��I���5�]"Bq�EPxLH1�"HH�(]�T��*aM2-���J��O<�Aj8W1����:��ł�Wl�Jݢ[�%�5�غ:�%Y��g��h�b+VY)�&�[&-+���Z����X?���εܮɅ�ڒr����im����60�vF2K�N�ݑB��C��7�\���&@��e��(�`׵�2���מ�����)��-��PR�U�ӏ]�e�	G���-BU������e�V����'�NR�cf)��v^,:�L@fl�ˌ]'C~�?&������K�[�B�Xz&i^�"�b,��V���K��ci8�����pƭlWhEk�v��������A��"&6��W�V�U�+KQ���4�NNM'�6��:�q�
�D՗ŃL̑��ꐡ��81�|���'�)*K�p���Yq؆*أP$:	�+Bx�P�c������Gq�H�w����L�1�Js��c�S�A'���[�	#<
�d�a?���E}�}<�T$ι����D�_����4�� -d�� D�s���,��So-%��pe=�����k9�$�{W2���tB�/�vLŞw�Yy�D3�EĐv*����̝���稇J�\ svLs�e"#�e-�h�G��C�L,'��٩�*@�r�x+�6����U�8 ��=ZWIQ�)i�D�ä��Nr�s�	
��8�^ٖ���$�V|Jw#fϴ�Di+2���=7���R��8�qT����hmu4����7wR��8����˂|;y�7#W/f,��R!9M��`�;�p0�K�tczuJ`F<��SԬ�"?p&�>|K�E��%�1�V����-,����e�L���S]� X��6�q����x���_��J�e��2��.9vs�di���(2#>Y� �d�f0l"x\Z�<Ѹ��u�c���P��)\� ��!�����%��3J����Y�pc�!��D��y�z�
D�_��i���
�����Vg�;�vA�YR�5H�)�!��+�����[�b��_��w/������C�z���?ye�NY["q�(j�_�l�މ���N��A1��V��	��B�'�D,����9�!�o��4���IfhM��s	��)���e�r�#�	RF��{�@�N)��Nn.Rsr��9SsXX9�(�s�_�O��~�32�L)��H�60��Qy��6��p�oql̛�4����SWv>�o�cX�K�����m�h��uZ��d*�t��������+��j��&fC��������u��0t��$8E�R���p����P�.��5s���	i^��5)�n([�Į�U���iMr�.����6�ϫ�i�&y]�l���2�R!��3� &�/�� �/����	�W�#'�*ǿ�S�p�;��7�:�.�p���2� D?o�&��"@��x�$�q�<&W2n]ɿ�|��д�����S���'C{��xӮAh9�δ����8�T&����Ie��>�Go�nqC��q�� �4,�{HMEC� nջvlǀ|R����V��9��dP�`)2U�B��]�@nrg���9��WHdnᶅ�n�(�cp���|��jF��      �      x������ � �      �   �  x��ok�F�_+�"oZ�-���L���e[�B�hGA(�b��%ϖ��e��A�������6c�����_oDe�ǖl˖��n��
�9��s�����{t�C�������s�<������=�����KFF����@��P�4���s���<���ӸKE;Zk|�w��=����2?y�ߞ��s_@��=����>\����#��"Z<ӡ�}M;9�+��L����A�y�?@��A���Qt�J�c�u��]�dV�����j���إO��^"��Y���qA	r�V+� K8��f�
+3�E,�?qRZ�?��3�m�]v%�z��AN�F�{"�:$��	u�������,���B�-K�z�J[���Jˢ ��� EE��H�K#IU8I����F"/�DTT+}�R8�Z��kNqʲ�ofPJY��jf>�l�(å]�3먠���5Y�����v
�fo�4�E'�W�e���85{%����.���We�Z7.�W��.]���o���׿X�,�׿Q�����mdd�<Y!Hf����6�{��1���-��m߅cV�l�Z~�r�o	�,���m�X�	{�ќ���[�z�0,��]��q�����O���y�Řn�7��R�E�,�����N�pW�g��(�tv�Q����0:���r��М
�uP%a�%2�w�EųQ4�:Y%�aۃ�(�$�����?s���H����XF��c9��g�e�Њ�FѶ
ꚡ5�K��������� kZy�z�R��sLg��L`*��phuj���r�F�B<����i[���\5�ۦU�$�r��n�vww��ҷM�4����zެ��f�E����9U�u�n9�b��Y��Q��V�^3�)So�,�l�*Vr�4��M�8��=mY�""�/�y��j���1�k��E�Gן�yԌ6!M�-�^��g
�,��z�B�up��07��I�bN�c�,G�kNjw�qpj<�� O��L�ײI�a�mST{�[�6��>r�:I�9�d��"S:�
���n.&D�y P+3�)����:=/�U���m��c�N��`��b!�^0�R^<[a�kgC�|2{�7uxjԑ8�^��/���^��?Sȵ�94�l��~�0��425�ן���gH���_)��#e�#7ܩ�v9�\}���14�vCI�9�tRF��'�Y���I�c�t�ר���g5am.YC�cm��x��(�9�Yy���|]������o��@���l�wi�Cm
���G��O{9���w�ơЉ�����xF��{��@4�� ��hv����[C�c�K��d�#+0Ҵ���qt�·Q^�Ui�hs����H�{	�<���#��A�s(���Z���!��qz���"{���78ڀL>L�v�$$N��;]�����z]���n�N�x���"ǽ��a���D�(A�d,�{D̗>�f�r��	'��:�p���g��8�S�$����-%�p��}?q���Q��b��Q���:�"��nuM+h��UPW����9ZUS7�re��:��:�C���4� �C[����yޟ���@ѓ��9�u&��40��	������]��`qg<.:���r�f�h���A�(:'M���I�S$c�~4ői[}M>����<��Ǽm��ƖΪ�Zl��^XX���|�      �     x���k�F����ť��fF�Jᐝ�y7���BX�7�m�/�nl��6����B��9�r�	.�l���?�fF;����;��3K#�H�|</�w�� ����?	���?�g���2o�������@d�$�L?�.��_���-�;�ŏ����)�/)���+�.dJ�6���K�`���/��2���ݦ���g����T��Y��.+f�@���r��R�G�)���m�9e�ϧ>���/p�zX�O������j�^�5Ʈ�cϹ�J>c�� 7_�+�~���r��R�h>nv���j���(����׍�Ygڽ>�xx��5�)�AÌS�'}ʃ,�N;�r^��Y@�d�-`�>`�G���������{�ҕp�TcQQȏ��{��+0��0��>�P�K��C��K��F��Vjt:����^}��i���~��i���Fy�����E��Z�>_��w}�7����z���o��V����<]�t��غU�}{�3����������_t���Z���zw	z��[V�飥��_�s�[݇s3��sw����p���9���ktol����޷7�����ӇO��3&���mk��ٝ��{���Y�A�0�7�Z��0�s��o���߮���6 ��N�w������X���{ToUW��o�Iw�S]f�h+��L^M���a��s�Vu���|8�����eI��Sv�+��Z�?w��� �'�����r}��]�����֯^�N����#LL۟�$A�k	���j��촯�
�?Z�/�6ۏ�BM�d�� �%����(u���j�[]�C�Y[n�����2����rM�a�V�<i�gV����n}��i��w8Ӭs�j�>�m7ؑ� �w)r89��P�N�����f��x��s���S�Ȗ��3�L��Q�d1@#F���P4�P<f��b�u�CKcBlcš'�%
K�.z�1K��M2~�2��<����Ň��U|�z�'!��c����A1h�L�	(j6��A��q�d\-e����SP�ِKhc
gĒ0FG���l�1�V�Y%��|*x���MH4�xa���(MeF�#ԘM2fe�9y�m1{�Ü����+҄�F8Y��3��e�h�eȹΆsV��ͷ�
�����Aӄca4x3�fٵ���>�_�(����)��2t]`*B���{xg�`K���n��I���jv�+�P/́��7�x]9��*�4��p������G�iCq����x5c-#�ɘ���K�I�SM�&-$Kh�j�pg���$p�$��7y&GE&�vj 5�I �: ��P�N1<b�Kpg1��q�zF�Hq�����p]��.K�+�@&�i�*���Ǩ��p��e[\��rm��a.�$#}f�\(}*���pi���AE\�̖뀙���ލSF���=�qYa�a�bI����w@``8� td �0��N@Ge��:O���;�*	�\U@�2P��V���k�I #IE%e�ly�	F����vjH/��U�xC�L�13�������n2��Xe�(�
͊�Q_�Ɲ�E;���{Y}��$S�@�	O.�7e·X�6�T�����Vf�Y��葢&*�(�M�Zׇ�L�[��=��$��$��wq��t#-��a��B �Z�p�S���Rx�T��z�8h�&h�]Kۯ0�t�?��$t��	ON�.U.�^¨ѪA�0ŗ$*[�t\����4MZ�4��*�240C�bGRJ���ҁ_�)IWim���2�H��J�dq�p��,v0����W|/� gC�H���!M�d,�.��7���>����>�&v��%m�*��71!v�#��R[��Z�3���T%�AR�0J|</E�$*Gq�Ԕ騺��<� UieP�V�9�W'b����۰R&�K(�@M`�@ U^r���[���X�S�.ˋ���m�����E�7 �����`H����`A�Q�����8����M�d�R�G�z�c�����'���ȶ�I�:��Q�	,��a���rW�G)T�́�yjzCz@��/X־k�˚ǈR(I���qڈ\ir_ӥ�JхR�;�ٺ�Sv���ۀ���	�H/�Y��b
�.�҆)�J�j��1�F U�,kS�ύT��~�<�qc�(�OH�N4Q9DY �ҝ���N�g��(XЮ�jg�L�A��F~�r=~��h�JG�3"��ʗ����?B��zK�&]^��IS,Zo��ˣ��*
�Рl��D�� m�3�r���NS��ˣ�H�Ng�T�=,�q�^Ƕc?�#��r*E^t���E�e(YeĄ&p�	tV�S1e�
�A9d��K5z;���ZX1E)2�t�n�4iɭ��UiV��ʀk�E�����T�W"����.h�4���!��t-��k��\X�8��ô,g\�r�Gus���)+�2���"	�X�T8�"�UiS�mJ
�����?�$#���XG��E�=1�s5u�:JX�f��Ьx��p�ؓ�3�(��D�mf� 5Q�(J�	�*݉�e7��불�"+�R]Aa�E!R4iM��*=���I� �������7PԎir&�`U:s�#y�#)��+�F��@'C��k(h�����XC/��$�=>������l8d�Y>�WẢ�*�cD �H�DG,��=$lib'��
0��uqoxb/e����O}|Y�^ ���'E�e�O��̗��E��PЫԼH��{�ǱU��,���e�����~��oe��'�����+;ҷ@)S�.�*�������3�?��#v�0�߻KM���v}�/J^�W�+W�����      �   
  x��[Ao�6>+�"��4ˢd�Ҁ`����a��
��&Zb�p��C1`ݥ��+�.pI�"m�n�ʿ�O�hJ�$Z�H�S 1h��#���H!C�ܷ�;�ܑ�<��s�z�{���sO���y�'�}�<�gJ�����t�]���x�3����`��_>[�$Mz�m�������n�X?K[�����\>88��v��c�rk�]�ڭ�W���,��^���YQ�7[����S��o7;���������^�n�S�f�*u;��#�i�`qEE�n��H2I�zH���PU��J��>B��@?������1��/Y��I]�1D��̻��J��z�+�����2��bj���U�� x���H���<�3Z�ul�	�`�
��`�\(}�'P&���'�evk��9���L�_/��)��G��sF�Ɔ�ْ�m�km�My��Y&��k�����f�'��8�P a��8�0X��ʨ����rL��T���#V�%LSB�l�C#ï�JES��4v.��;��o8y<������e�?9v{x��.WV�w���hJ��|Գ�6���G���)��.W��	�LDBx�#�h�yʩ�g�fԌ8�ȇ���PPN�D{5sϰ��gN�L�BuV�Tn�T	�� <�� .8�<#�xB5���El3ԋρ@/�C���`��������6�"ˁ�3&�P�h�P��\�"WC������V��Y� L@H�JaN�#(7Q4��lU�IɄM�/_!��1��}B��W�F=fB���G��e0���T�H����-�.E�Bmn�
�(1U��Qn�d����ܿ�It��w$U��g3���"6a�GK@?]�$tUQ���MA�rj}����`�
Q�"��3gV󢚞im�#Ql������-A�R��F�ڼz T�-�HSy�Rb�7�|b�X��\H�˩D�+~� ϟiM�D<._R ��{�CU�kҖ>�<I�D���K7<���_��P͐���p׎��#u�SL0�%Y���Ss�odu��X�� O!�s�j⊜���I��3o����Qϐ2��Hչ�Ba)x�8�� <s̭θ�|Q���t�4�K��94Y��B}fL��"���fJDY!���i�]�/۝����~��Ύ�~5�iP]���Åm&�K>Ⱦ��l9�ng�Թճ6v����2̢x�1�
�G��A(�JgY���ׇ��Xp3c���Γ��m�� U)�đ���F�ִł�������2�a��T����./ʴQ��x���NLfHSk����O���S�!:�A�0�
��� ��Ca�BB�V=:Ƣg21�o���z���r�J�= ̯�}x��0�\����H��"�X3�I���E��^��}`x �#|�'�7�3���k���c��O7���W�E^�1�lWE�x��5`2��M*j^Si�#SC���¿���/N���R�O�f�\=4~W-ga�0�T����ܑ�OBo�ef%�����=yee�?�y�	      �   �  x��[[kG~^�
�b����o�֮K_�_`�����.�vE)�:�	�đJmSҺZ����O��ٝ�jך]�Z��1��9g���eC"���s����W�D�1��|I�?�N�����[���!����S�1[�ϠA{�|#�?�o�H�����[��|@�&�8���HB�w�Zg��v>{�6j;�����^{�sY�v��׬�xlF��j�m���u�oKF�^��t[�Tk�zk��W��oԚ����m5K��n��ՃV��pK����i���%���*��@?�`�=^Na�/��)Ɉ�~	wr#�����X�|�^�@/��.S:�vV��H�<��������ϐ��#��z����H�Ų�Tt[RPŖ��c��fR���Ҋ/Kx���O��b�-�^��2c�?�}�wb��C�}�}CzK�X�o��½�Ao��W�7�K �^aT�B#I��T�3�߉�����v��=���W+�:[2�&�*��h�G+>�ć���ˉ��&�ѡa-��T���H�e�~�m�7z覫�Rʊ��?�he�0Y3�Gv/�;�&ǉ���pR}Xj��p'�B�y��Vm�l�	����l���<��d �(=q�+^g����U�[����v���յ�~׭?+*���Zc������%����"#����J��E�ʢȞ ON��v����5W#�����S<�M��9s�u3#�D�0<�bޏ	��"�u�|�V)ɽ�)j�h�����I���1� 9c�V��<8�ƕ�@�Ƴø�Ҫ��j��� QA���È�!,���N ��yh7D��RM���c.�K>���`!�w��Ń�1�X�"F�i�[*��v���u��+@�S�GH�0�"v�P�S�_�L遏�sC��!�N=���'~�����ʎC��"O��W��O�FH�����TV������|����������:@@������?Zw�"^:˛�<�=+T��8@����PXS���,B�`��\��9ٹ�9��}#R��Dׄ5�A��9�e���l3w�?�df���f�)�����ލB+�1��Z�^*�"K,�q�DbCE����D�
�����/
����s�x�r������A"�S�^�כ���3�#��s�2�/i�CEDK��E)~�:,ў~������)p	���ը����&@>|o�d%�d*|���W%��f��y�J�����6��P��6NW���Q<��?SPT��"u�@5�/Yթ��S,7�8�L���-�>���P�Y��H&1c�9��z}�}#(��Wj�>�! ������TW�P׌apR]f�����(�R��� �(�R�?���ҳ0rA�l�=i-�,�,�����)�sM���.���g���,��O��	���(02F��)���Ur�OvJL�奥�� t��      �   �  x��]�o�H�l�
a�5�[{%tJX��e�!��y�l�k�T%Y�N��=���i��PZU�"N���u��)7�glό]'M��9(X�=/�ǿ��mƺ�{;���{�����������}���d��<8��SUtG�(	e��/p�?����v}� ����՟��\M��!Q�u8��OPsO��_��	j��%������1����1�}�{TPx�]����ux�x�cz"ρ:xcބ� �����`��!|k#�'�5=A��@=|q��	��}]Y��W�|Z.��Jw�����B�-�������+���}޹���ड��s�ւ+�M�8��A�_M�e���z]G�/��hFI7��a(@	4���w���o%-"�#�S�7rs�Օ�� MvbMB��^����)e�.�j�����m5�7���{���4M3KZ]T��#������Ҧ�+fM�s�]i�e��[�n���3w��m�?����/Qs�$��3	fJ̙��`���C�JXy3-",z.����~������(��Ŷ�"*���y�C���ÌaJ,R�WtZX��8�e�+����<�ܽ{����ί�Wݵ~	�T^m�/���ߴ�z�2��WKk���A�?�4�ݹ��ڝ^wnp��6מκn�5��]�+%t�x�迾 \�;5}H�"5��r��([!EgC/�bȬ$Kzz�!�a�0v,&�ZS1r��O Rt0�x�a��m�>�����J�
،j� �z#.\�वؕJ�Qi)fN���4� `�����<�I����=e��0*%�QcУWj<N��`�qZ�MzV��ӯ/.��X{xZG��U/&b9��r���p��u '��	�9P���˼vjSŵ>�l57�ֆ�@jC��:��a�X����8̾b�TM�j���i�}j�<�o�>]�-����1�`m�3?��W *�?q�j���@��m�����yN
H.$�¸�H��;�v:v��up~�4�ɞ�l{�����f6�<t$Ƞ(�ӄ�<ƀU��0��`�37������iu���%�t=`�%�%����~�&ŏ���*�xX+0k����8x�O��m�>E��j� ��tvq�]��1����7H�WU���ٽ�Ia���T2�3��
��;�ݚYZ�yE���5���"%�����9�s�T��bh��MJ'<�:D�7�RA��YK�c��-�q��K�:��G"�#�I�y?���6\X.!2�Ȝ܋�1*�X���{xˊ�q4F��B�c~b�PB̘>?�S7S ��.������;X� ��EG�c�#���\|D����� 7�YR'�~D�g�v��9A�I��,(�WΚ!\���Q����*1~X�����|0�UnNJͲ�Ռ&)��E={�*F�	�$'�T���P7�̻x��2J�chU3�y6"}���\luA�E�9C_5G	%�ǰu�C��C��!�؄s5E��^j�35)�k��T#���C�>5���-k$�	4�C�%�XA���.�_���{-tOr�����\�J_P�12JK���좗���sUޱ�+mB�m��󍩂RE� �^S��Z���/�����{�&�����
��):��x�x��"�wѽ׎\��䮑�C�mZ�}BV�c�O�;�}i������ݲ�M��Қۼ����7��n��D�ĝ2'�S3p3>�M��vw��}iui���v�uiUM���`���WD��~���۽�%���O�Z+���ٲ]X�0�9��li;Ʋ�q��}Fo���!N⾤���T/�(��(����j5����Ox��yi+X1�0;o1/�d��������plB�Z⌥���Sh��|?�
\�oIn&��-?r�H�jX�%��V��h�&����b$9��R��bIK�hbi&�� ���Bya�|��շ_�ѼU�/>h^�M��.`tT����������i��	��A����▎�r�14��<M�Ǆv�C�d^Y�y�@�`����r���i)�4! �.��2E[hx��c8ϧ��+a��3`��F�x�MuQ1bU����k%����@�T�&J���H�B0����9"��p�yH��#j3�Ӊ�-����ɜ9�:h�i�c�11(FYY�@Ƞ���m(F^�3�JYLQ�ٓ��MF�
n���7nj��;0�?/"�0-|�lX�!�͎�-[nOh�ڂ�f�Yx��s^��Da{@��� :�	���&�6Aqp�. ?4�?�lÛAS�����
�T!1�W �Hd�>�T����@���k�i�6_k|�ka�劂~9A9��n��܍$A`E8E��D%%���|�$���!�<��P�l���(�H���?�i7fƼ��.5��zm������a���p��:e��	�2\u��?@�[��PO�)���ԃZ��w)𰁭�E69�8:LV�r�h���l�"��S��@��R&�f�e�RD�Y���A1=�8vL\�e���k�����I ,�n��1�*�y�z����=?�m6��R�ٍ\�H�0���� ;��~o�X5u`��b�h��#��*�n��K\��<�>�"k���F���c�4
L��sVM^��Q?sL��u�VAf�[+k��vw��uo�־�~��.ށ��N��쮹���^�M$&�J,FnJ"Wi�G�9e�!al������#l���,/�������C�P̼bN&��Vt�*Y4�%(�#�e˘��{���F�	@�(>����Tr���eJ�9�7GZ��r�PEtō*E,.�G��j�rpUuB���A�ͦVt�b�.2�2��/�����л�����
�,��<Y���4{<��-U�%5ԯ��jcн�4p��Ir�D�W$d#���xM5{��F(�w� i���2��?���w-�g�PfS�}��� �S|$X�oJH�`C���O'����(��Ӌ����q�)���-�_<�6?�ymjc��V�M�5H���5m�\��Yq�/��`��3Q�e�g���لE��E�!��,	l�x�j1gks1rl)Ȗ b��r�k�;�8�%�V$Δ����@�Ӎ<!VM"PB��D�3��a�<��T3/�d�V�I���(�ET�QW��ӳ��
@�ߍ=�C�g��K�ד�fJ�ޗ���Z�]~z)��M�rb��[Нm�q�(�tQJ��pϮ~X#u��Y����a�TI.O^Q�K\�.4�� ��gp厀hY�D���Q�W����wp�J�l��;ƃ�� �ᆄlӮiq�o���x���E�C�H�1��5�*1�(�hfj!�h�1D��$�B�A�=�fB���'*�w`H�rA�;;�Ե����P�Y�)�H��J��P���V��=%�T��=�mQ�tR�����������P[���'����G�-��-ŗ|�x�lg���N8�^��:�睍��v&�]:w��� ��U�          �
  x��\[o�F~��^$@-qHQ��7�I_�.l�>��h-ձ$��EQ`����-�q���cIm�dT�7�);s�ކ7���MP3Ù����m�R&㗓�����d2~7�&�S��JAX7�Ũ�V��������kr�-�9�'4�7��ts>�>�A	��c?ٳ#��%���
&�PBk_C�U�{ЂV�A�=Nމ�L�q�B�����>��ǜn���'���;�B���B�Bm7R��KA����>ؘ@U{8�o��V��;��N���cU{���U�uO���o�{����,i�M�~�M^����!U�B�XW�)?�u&l^����;�%�K�#����H�8D/
��4����$�!	�,i������������z����V���}aW�۴|����]_]t~-�޵v��/��
g�������k^�W����כ֓�7b����j��]{��[�a�W�w�w�G��j��� uu�Z[�mw����M���o�z�����`����u���b��%Uz�hH���������hOW���1�\2� `�0�?|��Y�߼�|������xĆ�f��SBf�:�j
��fN��W��t�Ći(W	ƚ���^TN�]�� ]�H�px���7�Q�&������^������a$Ü�I�߃n<�����r�D��Jb�(���Q��%R�%W��q���#�ˉ����|?�	�v���L��Y=����M�;7�NX?�*
��X�P�_}+��T*`ֱ���RS$��q���%3��^�+q�'�J� �h�̟��=ӟ��H<�N��Z�TA/�%�g3N�-`&�\8��DQ&��GLu3o�P3,�31�y��V՝i1b���6ݐ�@�B,���	��ɢ���w[�O�ښ7p>��P��]��� `:�����f����(���hHe�z�=�g����K�@8���x��9��1�Qdf�	^3+Ơ�]@��I�QmRϡ�^��?g���}���˟,A_�ٌ:7j�r�G��\3�[P�S^"��`�mB�C�E�B؍���\����M���/�@������sבFq�3�
�$O��1�ҀO��g�Mr�8=��P ӕ$(0��L�Lr��%#VKz%p�Se^%�� ^l����T|�tL�⍈3>� �X�
�2�%w��)�ծ�FS3�)�$!�p^U$8"h�f~ҁ(h��'\<�T<\��C��H��,Ȕؠs��u@�.��3n�} �~��[E7u�����8	���*_�)H�3�P�Q����y�ԯg�+=�X�X|�Ǒc���J(>�.VxgKs?c��"��r�'_��Θz�	��)�D�6��MW����r=�DJ�롈�*�������?)� mD�w��k�I<�=c���u���*�q9y9���]�$WC1����wp��A-�T�'f*�X�z�K�!Ϝ��MMzt�5Xf�H�k�U�H�--=g�&�7_:A���8N��cմE��I�+�Md+�pP�M�����6����܋K3&X�7�$�: ��N� B��wE��1�P6�hYW�$	��P	�5r�φ�eL,�!%���/�0S��������j6��?i��V��cI)VGR���N�T!/�3ao��::�Ѽh�:o��9X��.�%&s�$QH�)G�5��v��6������:p�T! �O/�|�$����.����m�aψT�Nn���47EbaƭFUR��T�4�Z�̺T"��C ��>���p��.����� d=���˲Ҝ�CƆ���Ђ�� �υ���8!iM؝�e/xկa�1r�4��/ 	�p��r�~����[��P��ш��,�d�E��^� p�c�*	�Jɐ�d�ZԮ#T�E+��^����hr'�޴;�@CP���lT3�6���-M	/E�������V/.c9�s�F����E��\^��Rߗ��/:�
�wj����ia(�2���yw��֩�B�/HR4W�.�0��7��������äl�R�*��0��]3k&�-�;�?����ϭ�����(pn�:
wM%���zʍu�I�Ή����(l�'+�m;�'���;�}�@�N�S��n^�o+>��#��CO��9K��|���K��g$_|5�8J�Dq�
	cɟ8�%�� Y��)@���-���+V�my�S��X�L��Mϙ�q
�������q�L�\�Q��)���\��*_�8�&�9'�˥����P�G��1���G�f���g��FvU.�[�&�����dc*��1�a����Y�P���AH�J�/;���9[��&��s�����:ڙ����ۇI*���9H���^�΢��w��r�=t�ӝ�d3|�a��c&87-X�����<7mNHFa�}qM��;�=n����,��zV�(��p����Z��4�t���us#��^M���O�+N�T>�u�+�u�-Zy[%c�O�;|`mT��{���m�w�Z�r��nX�6�����s�vXÈ�>ϡ�J>x�
#:�0���W>�6�u뫎��n�إQy[�'u ��YV]�nGG>%����Fh��-�R��אD����j֣ڃ��Z}ئ>�����m���/W��Jˮ��
���l�DF�j����Ou��՛8&�����w?[+d�B������;��'�d=3%��\X�!86�f��7������x�x�R]XX�?g��         G  x��[o�0ǟ�O�K�؉s1o)Lb�@�p�&MmV���	�h\��x٘x�!�m���&�1��m�Q��:j�u�J^R����s�??_d���>�?��-�l��Sa�Fw����d�#�g ���A&X�w�a�B�1�1�r,��|M�=��y�C,�zq��a����p%��KaU�:C���,W��{hT̡A�I��)Re���o�>P�쩟���4'��b�֌�8��A�24ӹs��
G/�?1����hv���+�������x.6��.r 4Z/kQ��4�<�Y� R�)���@�N���$�|ݪ6�o�DVWW�8l�0�v�L�0X
;F-lȱ5��	��� ��ힶ�oU�Z\�t�����;Z�v�U��vCztn��wy��9 �T��{O4T3I�2����|��d�	PN�X�֏2�CF�	<A����Z�A�N�@X�+0s�O��hd�_�~e��F���lA���	{(��s_n*g���fs�0�\\��1(6�9��L�Wr�S�9�UDp�\�pd���p���)�ݓN���$\ ϴ
8���NNpx��E�<�&���#A.���7'P�u�"c�p:�gkIƈ�����r! �XC<� $�K3H^���	�l�.+�ޣ%x�u�L��-���� �޲r���λ����#�{����7�2��.T a�q'"3��T�9�9>�(�)�Xy������������Y��g�NN�~܌�KR�֘BR/��֊�]��vN3BԟV
��U&��(6J*�T�ܺ��h��r����� M2���\�R35��R��:�FJ         �  x��]_o�Ff>�_$@-i�Od��W��z��ˁ�m�VcK�-7(��"@r��p��M��ھ�SR_\ȸ/#���K�ܥ�+���B&�8������i���hx4�]|9>]�u4<��?�����1\=�?�Fç�����ᜮ!ô����m^���G���.|�Kvd���5��Ms�>I���n|�8"������6����4�9A���<��\=�!��?&������n�>X�������+���Z������7��y���K��,6��;�4�3��q�{��R+:��~�K�f��J��F��͋V4��F��HǼ�0j���51QN�
���aD��qR�����z/�L��yJ'=q��K��S:&�&sk�������Nwm��ڮ-�6�w�˽���w�=e��7�So4�z����O�3�ý��"@���b��h��R��ݻ�~������[��Y^�l՗:kud[����_^��t�;�~w�����uv��[���[��l/��kp����?��]ӧF<2�����4<�wq�Ղ�I뀪�@�oa�W�%�~1�x�T"<J�I#�;�'�G��|;��	���K�����Դ`:Bl��R�Cn�������Q��o.��:��~�������V|����mzK�;�������V:ޒg��]#���ࢆ���j��@3�@V����Lc
�3�iy8��� {�� C�JX��:#&dg:�� :y��/��yLӤD�L7��h�]d�qS&9rgHS�D���R�D�ZơJ�I�8C3����$�)�@� ӚZ(r����G��|�f1V?`���O"hG=f��T�N��30I0���-�"
�|��q*i�\Z��!iu�o}��G��gM?�i{�U���h��z;�������J{�\�kwz[�] ��VN�T��"Ӷ�%P.�^������ge�3yZs�s1A�%����:�Z��ȣ�E�(0 �lN��%W8f�K|��,�Ř5��ڌ�{v�����5KB��� d ��� ��v�9a
L���Tl����L��f��ЬYfS��
�"0lf�ْ`��	� �S��Ӑ��# ���R¿+V��)�MGk*¦;p >���1e���V6���4���\+�̭T��Z\���y]YѲ"��E"I�ݭ@$ ˜����C�-���(�?32�*���o��mU��M�ih�*��9m%���\�(�ME����~�Ay���=MN)�ŗh4ؚ=*+�4*1��`��`' �#@�(���r������L\S0������%�ڵ�st��p�2�^[T;�~({W2��x�Iw+K��q�!`��2^T�L��p
/"��*�A�������s���z;�H�+N����ك�F-�j%/-}0b��C����.ą�0G�>S&��`��ѣ�!�Jq�Wy���3�Ozm\�g���	�Ӗ�/$?4��nt�<ү�J�ݕ���
m�h�$S�����Y��υ��^�nw��;�=����&P^��d'@�!P��<�V̬.�nf���¶�g�&��֬�u,E=7MDm 5l��H[Π�P�/��9�	nz'w]���j{��H�F�r�o�
XZ@4
n6Z�@���|1!*o$��v��-q�-���Z~Ԑ�{��85Y!C'��*�5�͓J�HKG�T��"��^ �������M��d7�?���|/QF���*��/��v�['+�I#�-a�A����8g[�&��ɠ�֝�*Y`�
�qL)��ZQ�Ō����3�hUW��/��Tӥ706	>L|��]H�S��B�.�/f�?3�'UX�'`�}�HQ/�B��(G0��{xe��{h��w�R�d�?������/_���'���N��yA���Fi��ϳ���Oo}��Y�UY���AS�6,�����{Ho�s��ج}��ͨ_a�ji"�I]�U����f&#������T�"c՘�c������ �+U�NaY��*z�s���0?���9��҇+�',]K�A9�x�h�K���͔�R�� a�S�f�����mi;���'�0�	ޑ���E5�����O�ɯ��m-�QK�����Q�Q�e�����0g�pqL��$<v��\9"�x�]<f[�|k||����)�����p�5]Ue7��\b"`���<�7�UU�̯=�%��Y�Q��#X,�:�'�@ӓ]{p�O��?�ɏ��>�F�ڇ���/=�%�F��6���=�H@�{p�@t:�i���&M��w�/�%��8�ri��&��O���!%��=�;��%��u����s���]�����g�?<��r������.��'g����'a&R��:���I9�7�4r�P�H�#53��|Ғ��ٲšW�N����s������v��b����@���!���"�!z�f��D����1���!��^�g��e2$eM<�̈́�X'�<�q�����#��1��$���tr _j�/�2�M{x?�%[�v�V>i9�0�@Y�[ ��7:n�R�	o����� xK�io�(�II9u��LJ��Ҹq���hȰ�C��)��!΢5�.�DՃ�
�d"hg��Eӊ���W���7+]廌��� ����۵ȁm��,��i�'8�\Q3T����Y�@�=E�\A��k��	�4ߙl�ݍ�ۏhtH<7f
Nƞ�81��,��f��7��� ����H����c�=�r<^��=	�.�KW��Yv��\��u�lna��ϴlF&�.�i��Y�Z8��^�]+���IC!O���b�"��`�3K�ƶE(�3E>x"8�F�>ˠ�_
ϣH$a&+n~ �N�䖾L���ڨ�'�<S�J�rǊ�L���p0P�;�(�
�Q������4�3>G�ދ����Wj]1V�v����Z]a�B�6�
 �u��h�r*�-�Pv��j{|#@��T�J�"[	"�+��t�˻	?Y9Y��� g��d:����'1}��I�_�G���vٔ��xm�E01mr_�4a�@x��n$��L���3;�3��`�T�.�)�z{��
^n���ަ7�;������7�Ҽ�Fﻎ�J9��ʗ�!��������..R�6%���ti�J�L�E��Mh��ڝV�O'���⿮���>{"����pR�\Ux�bo�/R�E�Cx�cJ��]�lq�۲pe�>������|#�	��I�`�͘�)C�0�6��ա�b25<EN��ʽ<��grM�re`H52��$� �o�N��22�j�l�8iPY����G���[� 0��uq|u��3!}dhe�_7í���d����O�f2����!F����2������=�ER�'D���hNb�ו�7Wh�f}��',V��R���P"	�v��־��UZ��K,�Z�`'/�4DC��%�@q�c�=v�$���!YU�@cd"����g�伮ԏRl 涚�	�T�ː%p�<�X\�v�!�D��w�H`('5B��Hp���UH6��S�a�J��(L�E�
�i�0�L�s��#Q;ӵ7�$5�ޤL]R�14�d�ؖ{�����ߗ��)��ޫt�3��jx�5n�o�{oQ��8U7T��]�&����͂�f�٨��7�zk^�����O�>����|���Wra������wg��ۃ�F�[�xK��=8���X@:jx�~����Lώ�?�՛.��"��ǩ��r�\�"�%�e�K¢�)�Ȭ����z�ռ�Z�7�%x�m����r��\&в<��^)Xuf�s�]�*��B9�V�/�?�`_��H�� n8�k�D���IѻIɔr]F�eK�L5�x��Jb@D�|��n+�iE�_�&7�b�n�,"�Xfy��ԋ\�l���9�<�z�	&L(8���¬��5�<�Sɜ\�8�� 8�j�X��vg{�w�I!f�`W�&+�K�G7ݮ]�v��bX�#            x��]ko�V����
}I� �)^$�;i�A�"��  �H��ؖIN��X`�	`7�鴓d�7�a��lv�4���F?ex�ṓI�[��L�;�y��5�������~�~�E����{���{��?�{O����S��уe��{���kP��c��Xw��?����~��낦z���#��kE���
<��w�C��m��.l><�_���J=ƃx�k�e�����f���;�3:ƃ�zx	Þs�f��ќGNL� �~�|�W��q@8�Z������mt?{����=�0�D�`�����*��,�}���z����7E���k�f��:��֪�R.}T��l^�>�,����~���h�IƯ�T�úd�Z~��f���eS���O��0���}y?��N-q̤w���U��W��\ĵT~�ޏe�e:��RN��E��¢aj������XO�W�������ÑE�_G��*�K�f�_Yx,K\Z���/�nW�j_�8L���Je�N��QLZZ���J���
�������������4+k��f��Xin(nUQU�dXz��{R�Z'˅��U­��4\_�~d[��=�d���]_��bP�%��pI[-ŉ,�W���$��dJ��ғ�M�T���=�,/�xd͋��POz�RҔ�E4ˋ�6W����V0������C�������ʇ���?|�6,}��������Ƿ>v���zP����W�k�2뷯~���6?�a���$�)=zt޿�ɫ9U��׆�^�o���6כNҧ�>Aj�xg`��h+�bʧnc�^ުV���fuű�ַ֝��ZL �j�^��i�a���k:$�V	��c�����yq��5�,�
N�ě����i&@8��,��(y��Ƌ���O=�x��:�����=�!���l���L._�C���H��/�1]P�J��)��%�U$�GI~A|E[�0#�hF�0�8��q�y�0�G�RB4K�
D��Y�;���ݺ�������QCA�2k�eL&�c����'��xR<.+�y�)(Ɨ+�#G2IV#>H<�j�J�����C�T�4F�"la3��
7]���)�!��3ܒ��H'%�-�[����T���Z��i���;M�TJ���Jz��1s�P�	jw�O���s4�x�	�I���m�}��`4����.��r�tI������%У�ٍq�>�O����CTRAP�_8T�j�P����iL�E.�к���z�a\m9Cx���4��e/=�3R#��R���֛�f�vՆ`�F�{[��b�v���fVZ��K������_1�#x�E}R����@�lhߥA�%<�!��7v1�z����gv�
��G$><��.>�9�q�P�ö�c24��d�����Kx�
w���L% �x��'r�|/�]��]�uv�J��;�On/���'D%\���e�5C��3���נM���ѡ�b�H��f"�������f��כ7J�Bq��k������!�@v�Q2'�ZL��h=��4�. ��0�{��S���8����dJ��1���G<�U4��y8g��C��<�FBO�g?�Ǐ�x	#0j�y�c(�pq��А���;�0�����
�7P;��:�M~����+ܺD��Ȫ)��H�+�����j�`3����h���UWK�bJ�ZRJ喳��%�js��r�P�.n6Vs��QNISb5�iF91 '��|u�� ��c���zAϱ�
��hO��
�9,�V�<�[�aM�}0��{�3���<�`�Z*�`�f��bf
��I���4��e-=B+�FhU��+o��{N��n6���f��r܎��j�٬CE"Fmf�6%hS�ϴ&�L._a�������Pl���Ӌ�yP�`>��J�#�}����[o"j�.4(���|�`O���/��c�83�@$F��|(ʢ%�X(?��_2*�D�вܠ�O_;˸&u&M,��K��`�%�(���f8P�H�yJ4�8��C��rzBle��|�"�t���nT<X��e�.�N���7��[m��L�� ���R=,��(�XL'������R�X��4#��$.y]���9l��]�2,�ꝁ=���<��
>���O�'X� .�k��G����H�C�]��/�?��-�3��U��=�o�l���<��ٚx���*�yjp�����������1]v��n��٨�BLB@���:�N ���c��ټ���f.�	����l�<v*�/$<V`$,+y��f��t�"	ITd���eG �����TZFR̓¦$ăJDT_�����7+�}$͐"�L��D�L�'��x<��I/\��Kce�|WYrk͍v���ـ���[�]O$�5�Gnþ�����S��y�?q�U+�W��k�'�Uk��F˶Tu�dY:����>�X�S�E�a� �h��y9'#N�����"�& ����y���9��q4�|��!��^w Rf�|>��f�+��uT>�);Y�L�9^jx���c����E��g��	3H��s���� �c���gܺ���O�T��K�a�!�:������-q��e*�đ���AÄ���`W�#<�S߷`�Gh�
��vW?����̺pG����8>}	g��ͳ�g�����HD̜�\��$�2�L��h�'�����\Z9�Q���*]�g7WV܊�b��U_lR��k��}���Oӊ��/���I��<��e�8�.�'Z���@ ]�jBT�O��+�б�>Q|=��K�"k]�e��G�5�IB,u(��������$ff{��Kh<�P����D��	'pq�%���dsg���
/�3vVlm��'�S�l��]Ѵ�d��=4�D���0���w蠐�;d���q�@<T56�6��+� ��0:S��V�? ��JF�=LSQ*+�pP]�M�m0G 6�W�g����f���b]S�q��d�` '@gpXņ�kJ��))?��@�����T%��k�XE��mb+5�Z?x�`q�mT��M�Ձ2�[��-宻�������el�Rin5:�����Yk�����v���V�_g���Ar�bso��a��z4MK~-�@C�[A�U�>��io��������.v�4�O���t2�i�Z��d$�<<��oSF��Ox�A��G�`٠^`Q�nj;��AH��%���<���o����3OӁ�b�=��@M"�대��*���b$I_�\��$y�و�1F�B�4���Up�sy�:6�
�g�q�{bl�2�>q?{�#�`Co;?,����p�3|�Y{&)1�@�Ӣ3�cB�2��;o�G�4&�!̄i��Gӊ�E_��7��T� �Ԍ�!O�.��W�c��5�_���!�$x��k���{2�P�������e�å!��PvF�{xP�(�*����yT�{�9E�HĢXv�gX�G�����Nd��:f�! ����d{�Ui�4����롯�\��&nI�Kj����8j&C�.G)%B�����D�0%^��g��,V��`q����t�{Xx0�.�����e�.|^`�����޽��ǯ��"4�L��y.|L��)�ݢH@���> էK.��=�b��&Г2���8,=GR�a���$�1y���5<�D�ؘ��ՠ�ɴ��2{����	��^����d)ܳȒ�� Q��9���AE>�F!(��$�z>E?Ce�� �ä8¦�`��}80`���1	��	�����1v�s��c�]����X��@��Z��t��8��H�t�aW��_0="�R!�@���asB`�1c���!�������BE��户�s|!^hd>B�`�8��3�
h�2�{���VI�C�u}��#�2)c�a�'9ܪ �:s=,п���s�b=�&c8p[�v�3�Ԕ�ت����ݶ�rՖ�]�0C�Ҷ�����$%�"���+�8^�W���U��4��$���1�󝌕Y�h�����A i
  �'8Y�S�z��b��x�`�DMȇ�XH�0�)�x�T�xtJ��Ц��RrHM@P�H�P?���+�M��Uj��}�i4���
�O+$ީo
A��ND�z�K5yi�UQZ�M��c7�>�Y���#\�]RΙ� �R�b���tB����Ð�gA���C<.*�U�~H"~J��QM�����5��!'MM3#cL>���s���E�;%U���-����H_Xw�={"i�ŚQN��K���z`��A≠��&Kl�`p����?�d�2\��ɏCo�����s���%��%ف�$;(� �>m���1s�;�U��#b�v�j�-��i1�Xؾ�R��4U�@̀���M����d�l��L��D���Q��ViL�*(�/`@���X�F�'T�	�NgX"��CPJUQk�R6�;w=�w��l��[���ӌ�>����:r�F�@l��e���`��bJ�/g���C<������#MQ{{�����a�4_����2t��Sf����Ah�d��,�G�&_12E���+s�5�����PH<�F���u����������an����ȊurB�x��"�Q�uq�ժ�)щ}iϟ�1Y$���DNS��Y����n���E���BϞ>��_RJ��Ӯ;�:	��a��^�h���'���#�0=��$+)��wz�)3@�L}���a�>-�[,ȍ��9�7���*;g?Ń;F
��~��������D F�]F�M4���Ԗ�=���v�H˗E��4�X����s����&U��)�ܰ��������A�J]��%��.�2�!���[��{�'�	�!,ʯ����1���+�� A;�՚I3秅`I����ʩ	���[�Ť�����s�jJq�j@Qw{�RwZn�Y�Z�Uc��P2ē�=������Ţ������E���g7x�\bJ,P��1T�m�G���Jm�%2�
I��\�]��Te���D��_�<6��x�Њ��QW���=��t����s�ioU%�9�G<�4�V���y�9NJ��<ne 
�v�Ku����s��I�������.v�>�7m}Ǜ���d�Ƴ��B^��J�2��@$�����8n`�3�[Ε�Qh�����w���ҽ�!�V4�8��Ub�P\!�A��8��T��5	���甐������
�j��2�������tva&'���^�0;΍3�4%s����^1O>;2B*��9��$眀��	��G�s�$�\�sӦWw|��%�[��r��<��#�:�=t��g�!f�(�G�y�.����@��/.��!/g�3���i��E:�D����/,�7�7�;�'�>������:(�\�ש���M�� ���;�Ө
`_��^#�L���œ�r��|3yt���]���I�K�lwq�����>�������� ]�p���q6���N �h��~��T���<�����o�b&IGTW�P�d�^�g��#��RZ�������iط��mױ�B�,�Q��	�]��������	a��.Ի���ӿ��W	�������-;���%ga��tq����n������g0�#��ϝ@-���R��R�IPd��V��p����n{-l�ցM�Rkռ�_y�A��tց~dv*�S�1���y��
 x*Q(�@
�HĆ����e�F
1[���D�2�q��^U��knW��}�zm�n���W#2_@8*!����ז�����u	g:�T8"j>mʤ��s�Q����ю������v�;����q�r�)��_��<��Ǌd��s%Ȣ̐�N�,��@+����ƫ�����BcRWǨ8b�/�q���/ǳ�p�f(�y(��y�zL�B��pw�#/�C��d]��7Q+�>�y��}�B��,���l��d���p鰌��$h�Ĳ�� f��0���np�;�S�hQ5�@;�x���/��İ���!r7�#�Y���In���u�����L�A��Ը[A)h�bq�嶜��l�W���+	��$[9�g'���j�cL3eC��J0'��ag'��s��z�vPW9������!�AUSro���q��h��벆��k94�h��	��M����Q��Fq�c���m��	�N����X������&�֩n��(�w-(�W<�����ųQL��1�/��n
�d֕cS}M���D"^�v\�#���`_(
����C�!� _�-�f���&�FՔ���8�Z�G��%i�L+ԉtA#�>":t~^���9?Nq��c]*�F+����ku�}�L�O���M�j���ԝ���sx�@+�R7 �?#l���o��H)��W��<ZWR�@;��n������\B5`*�
�^0�2���ެ!�_闸�(���q2��e��t�fTsҷ�����Q;1�.�4�
&ۀ!0ڃd6���V�-Ŀ�}?� u���A&R�#�=4����I��b���ư3�.k��k�ّ�Y<�ݖ����\���8ʏ�jW�Կ�>S�~L.s6�E"��R	Y�;V�aIl��z�#X����"��C2r�� �;򐩘%嚇�k@��5���s�,���{��/Aw�'         _  x���K�@�N���Rk�K��h�0���Pnmh3�$�)�����n���d t"�����7����̥.Y�E��C�=^߽����>�"����?��)nP�O�_�N�ߠ���W����^�nR����u���`yƌ$�J*��	�'��	&��[�t�Ga��6>����w��ML��r`y������.(O����K������Ș�8���;K�iz��y,I^S�k�c�M"�nC
~I��b^��x%*J(�Ep^+�M��md�%�U�U�S����Ȉkt�ᑵ��*�F/�WףȲ�EV���"��S�Nu������D�2m^����t�N�&uH��Oʰ�f�۶ՑI)Jo�W}�tIU�]�M�&���I�uR���&��U��X|�4�8�ڄC<�"�d�����MZƧY3�6�e�t-�T���Q}��焉�C`i����o�Ո�+���s�f���(�@����U��*L�_��/��m2��YdߌF`rj�f��	���H@q�0����j+���]��뉎i�Z�C\OdK�Y�����lHhQ-���K�*��l�T
�n�X�p;�U�v�`�B�"m��XЈL�:�2#�HA��*����,
gv��'��$ӪD��<�L�e,��8Qmq��ũ�jü"um��<Ӷ�X�ނk�[������n� g�[�Fe�!���k��>~�*;W�����,�D���$S��juy�[���%#�Ro�����ϱ�N��`��(��1���Ƒ������E4�֚��1{�Pʈ�Ż&�
bC�|�{m���2�����%�C	w�(�DՎ}���:z����8G;[�5#�W�\.�����         2  x��Z[kG~^��������E;�7�ICZRB�b#˖�$�P����I���������qh܆�����Μݙ]�E�]�,\�<�˙���s�� ɱ�;����ɱ��v췎}��'��җ�}���W�0���(�Kե?L@3���אs		��ʱ���s	�uCH�+�w�l�����B�!�L?����4J��G�n}�i�:�-�c�����W�-H�U����M/�U/�΋�uDe��1�u�y�)�H9�E��������KHQJjY5T�K0-�8/��.�g�ރ�`�0ڇ�x��S�-f)�I�p�X�u�sPxޕ����l"A̰����kY~d�j��aR�ln����No�۫���Z�%�
2dEc�uEURd���[̝N�ց��)L�E����q�ڮ�$z���-u���v�k� �۬m4{��斌���3��T�Z����5vZV{�[��;���~��֬y��ժ�u�[�S�	��]�ߊ:#�ML!��ź�6���0?��:bb�b߬�+�}B��a�>��Sg�,�O�����t��ȕ�/y^��ɠ�[	�V"��a-Z	�*�7K:@gUBa6�t�;�,Hk%�<2���i�eEV���	�)Z&b3N#�Ψ����h_L��>}!q�+���DU��x�\|�5���H�b�qH%�ۄ�Q���üds�.
P���T��&��5zV����ނ�P�%�>%���=ɀ�hOY�� �{�2MO2�1L���
?C���&p�ύ�jB�dz~�Kȿ����؏y�ٵ"pT]�b��=���.n%�|�Q�U��/���,�(߷Z��V�a��[�A�^�ݫ[�ꪊשׁdL)�	�D�\�Mod����������9��ONC�(C�N*�7Zef?!%����TGo�Ȇ|4���w��%�
��!�:j�����0QRP7O\����_|�*��K��i�4��Օ��,ib��ހmD�FioY�R�IdBd���b�j�z��#�[p2�����[�9�T^�,dNv&I$:�'"T8�9����%Ӌ`�)�s��D&�|�jXꖶ��EGW�S���mAf����ξ���O�Jwy]N�&�zL[� �	_�)E��>��D,� �r�w�	���s��I�"�e!�2b�6t�b3@�/`Qi�I^s�� �}6�k�g}��".o�,�7�>�p�gn��D&%�}�Iy%J�-�@�C�H�#�_'&�9q�����^q�'�)@��&S;�ȤG�I���.��c~ؘ32�1�ȱ?�T�D �&��kېҠEz4�q<Q�"�~S����f̹��%_�I�۬_5꾅W��@�tVX�!6�ă/�{W��
����Bс{�5����߃��C�}(܃]8�^8��lCب!'vyٟa5Nyb/t�r����� 0�å!��%���4{7 ������,P���������?��r�%ǵ�a]r�m~;���2�$h卻�98�S��&�o� Q��+Zq���\�� �̂�!�K�,�������O�e�;Z�J�!O(� /\¦X�����Vϗ:��>�U��/�{�������m*�%��G�������{���s���=2廙�}ɐ"j軲(��u�#�Q8j��"�'~��������ߥ�x�5	C�G@ϗɁpSz�@ܮ��Z��c�M�e�R��ki��ϵ�h�B߬&_����8'��#�Qg;���MI;<�>i�`WIj
�:�T��e�sZ�w6w.��a]8ApNS�������^2 ��^����y��|~o�#D�E��{t�:�o犸���n_�����������)�`           x���n�F�����&��T��U�?7U�V��j%k
���iZE��U�dwۋ*���H��F�V��J�F2���Q:>fl���m-���;g��q���m�ֹm�֥m�؝'�ub[G�/�G�{��A�O�~�2���vg۶N���.-�S[��ڵ;O��Nx��h[�֞m�������RG����m]�S(���?{F��t��̽9����;�o��'P���Q5����<oV3������:�4Z���/>��"~��n�(�$�b�݀"C /*,�P`�e攌��eQ�0�༘�Es01�0�Kg�qm��!�M�[�������p��Xt_a1��
=���F����Y�!��T���n������ė�z���^)�+d��0�G��Z%�:iS-��W�&��2�7+����+Fo{D�CynkM�����uۗx	�Lb�5���~��4ڑF�@�T�B�b�`[�lˢR�
/��;���O���u��}�iV���YӖǉ0�|���Ә�PX�"�U*J���+x�\�CJ��0�i��;-�\Ӎ�e� 9"���~6773M�(��&i����Ke���Wx�ϥ�7�%A%�R�m��j�N�tSkm4�t{Ck��R7d���n��� ��>r �� ��8t�8'K�~�X�1
 ?�ˍ b
� �0 ~��+wa��9�+

J�xnP��,��	��`S,rQa����Q.]Ӱ�� r<w�5�!�q� �Y�H�셟&yi�6�AAI��)<�����ڔ_ �aw�|<���dE�G#$�`V!�B��,���KP�)j2'�2jT��5e������<Q�d%^�	�SoE8(	1C��t����\�B����$O6
�*�@�l�BLY������0���3N
t�9�8 a� X⁆�ۺ���[�[���d�W��GFqL�u &8'���<}�{'��pN	q�E�Cvާ�Y �
w�eb��ҧտ��#��X�Y�7ԓ�N��b���%t��l9����x7�BN�+f=i+WN{Æ1��u�x�1f� �&z7��.Y`"E��u��C���rRT$�z�dPcYm[;����$���,U"������S�e�CBV�?9ǫ��]h{��BI�2Q�ǐ<�����%��$Z�Eת�n�SӴ�?�g���ۃ�y� '���/��Ն����^�8��]ň�b��$�<$(aG,3�Ԑ���"a�����̤C�<;�/�Zڑ��'�v�So)ePC\sŕ��uH�C��eAJW��'���O�j�%���B��R[S�yQ�W���B*D�P7*�}�A� &}
�Vo�4v��1�f�3t��j�ɦЫ�%T�1�-RTҔ9����=sKI�j4w�$
Nǐ��Rӿq1�d��W�D�g���O�-�:�=`h���2h�k=�B}��H�v�AۊF���~�&c���7ē?�I?��N�ī1�Xgo�fc�հ�כݗƐ2z~Fzf�h�梿gX���˙�jQ$�{e'XaA �*Č�bn.��.�"�Ǚ��� $�ݨ     