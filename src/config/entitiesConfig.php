<?php

enum TableName: string
{
    case CHAMPION = 'champions';
    case REGION = 'regions';
    case SKIN = 'skins';
    case ROLE = 'roles';
    case RELATION = 'relations';
    case REGIONGALLERY = 'region_gallerys';
    case MODEL = 'models';
}


enum ChampionConfig: string
{
    case ID = 'id';
    case NAME = 'name';
    case REGION = 'region';
    case ROLE = 'role';
    case TITLE = 'title';
    case VOICE = 'voice';
    case STORY = 'story';
    case SPLASHART = 'splash_art';
    case ANIMATEDSPLASHART = 'animated_splash_art';
    case POSITIONX = 'position_x';
    case POSITIONY = 'position_y';
    case RELEASEDATE = 'release_date';
    case UPDATEDDATE = 'updated_date';
}


enum RegionConfig: string
{
    case ID = 'id';
    case NAME = 'name';
    case TITLE = 'title';
    case STORY = 'story';
    case ICON = 'icon';
    case AVATAR = 'avatar';
    case BACKGROUND = 'background';
    case ANIMATEDBACKGROUND = 'animated_background';
}

enum SkinConfig: string
{
    case ID = 'id';
    case CHAMPION = 'champion';
    case NAME = 'name';
    case SPLASHART = 'splash_art';
}

enum RoleConfig: string
{
    case ID = 'id';
    case NAME = 'name';
    case ICON = 'icon';
}

enum RelationConfig: string
{
    case ID = 'id';
    case CHAMPION = 'champion';
    case RELATED = 'related';
    case RELATIONTYPE = 'relation_type';
}

enum RegionGalleryConfig: string
{
    case ID = 'id';
    case REGION = 'region';
    case GALLERY = 'gallery';
}

enum ModelConfig: string
{
    case ID = 'id';
    case CHAMPION = 'champion';
    case SKIN = 'skin';
    case MODEL = 'model';
    case POSTER = 'poster';
}