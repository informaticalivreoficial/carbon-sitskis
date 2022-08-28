<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Support\Cropper;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'categoria',
        'name',
        'content',
        'notas',
        'headline',
        'slug',
        'tags',
        'views',
        'cat_pai',        
        'comentarios',        
        'status',
        'ativacao',
        'tipo_pagamento',
        'thumb_legenda',
        'publish_at',
        'exibivalores',        
        'valor',
        'valor_vista',
        'valor_promocional'
    ];

    /**
     * Scopes
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    public function images()
    {
        return $this->hasMany(ProdutoGb::class, 'produto', 'id')->orderBy('cover', 'ASC');
    }
    
    public function countimages()
    {
        return $this->hasMany(ProdutoGb::class, 'produto', 'id')->count();
    }

    /**
     * Accerssors and Mutators
     */

    public function getContentWebAttribute()
    {
        return Str::words($this->content, '20', ' ...');
    }
    
    public function cover()
    {
        $images = $this->images();
        $cover = $images->where('cover', 1)->first(['path']);

        if(!$cover) {
            $images = $this->images();
            $cover = $images->first(['path']);
        }

        if(empty($cover['path']) || !Storage::disk()->exists($cover['path'])) {
            return url(asset('backend/assets/images/image.jpg'));
        }

        return Storage::url($cover['path']);
    }

    public function nocover()
    {
        $images = $this->images();
        $cover = $images->where('cover', 1)->first(['path']);

        if(!$cover) {
            $images = $this->images();
            $cover = $images->first(['path']);
        }

        if(empty($cover['path']) || !Storage::disk()->exists($cover['path'])) {
            return url(asset('backend/assets/images/image.jpg'));
        }

        return Storage::url($cover['path']);
    } 

    public function setTipopagamentoAttribute($value)
    {
        $this->attributes['tipo_pagamento'] = ($value == true || $value == '1' ? 1 : 0);
    }

    public function setExibirvaloresAttribute($value)
    {
        $this->attributes['exibivalores'] = ($value == true || $value == '1' ? 1 : 0);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }

    public function getPublishAtAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setSlug()
    {
        if(!empty($this->name)){
            $produto = Produto::where('name', $this->name)->first(); 
            if(!empty($produto) && $produto->id != $this->id){
                $this->attributes['slug'] = Str::slug($this->name) . '-' . $this->id;
            }else{
                $this->attributes['slug'] = Str::slug($this->name);
            }            
            $this->save();
        }
    }

    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getValorAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setValorVistaAttribute($value)
    {
        $this->attributes['valor_vista'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getValorVistaAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function setValorPromocionalAttribute($value)
    {
        $this->attributes['valor_promocional'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getValorPromocionalAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
