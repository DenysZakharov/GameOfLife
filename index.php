<?php
require 'GameOfLife.php';

use App\GameOfLife;

// Initialize the Game of Life with a 25x25 grid
$game = new GameOfLife(25, 25);

// Set up the Glider pattern in the middle of the universe
$game->setCellState(12, 12, 1);
$game->setCellState(13, 13, 1);
$game->setCellState(11, 14, 1);
$game->setCellState(12, 14, 1);
$game->setCellState(13, 14, 1);

// Run the simulation for 50 generations
for ($generation = 1; $generation <= 50; $generation++) {
    echo "Generation $generation" . PHP_EOL;
    $game->display();
    $game->applyRules();
    usleep(500000); // Optional: add a delay for better visualization
}
