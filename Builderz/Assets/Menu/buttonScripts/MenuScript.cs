using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class MenuScript : MonoBehaviour {

	
	public void StartGame(string SceneName)
	{
		SceneManager.LoadScene(SceneName);
	}

	public void RateUs(string url)
	{
		Application.OpenURL(url);
	}

	public void QuitGame()
	{
		Application.Quit();
	}
}
