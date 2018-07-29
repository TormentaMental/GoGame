<?php 

namespace GoGame;

class MemoryStore implements Store
{
    private $game;
  
    public function save(Game $game): void
    {
        $this->game = $game;
    }
  
    public function load(): Game
    {
        if ($this->isEmpty()) {
            throw new EmptyStoreException();
        }
        return $this->game;
    }
  
    public function reset(): void
    {
        $this->game = null;
    }
  
    public function isEmpty(): bool
    {
        return is_null($this->game);
    }
}

class EmptyStoreException extends \Exception
{
}
